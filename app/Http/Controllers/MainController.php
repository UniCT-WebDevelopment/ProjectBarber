<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Day;
use App\Models\Booking;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    function index()
    {
        return view('login');
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($user_data)) {
            $type_u = DB::table('users')->where('email', $user_data['email'])->value('type_user');
            $iduser = DB::table('users')->where('email', $user_data['email'])->value('id');
            $request->session()->put('data', $request->input());
            $request->session()->put('iduser', $iduser);
            //check if is an admin, employee or client
            if ($type_u == "admin") {
                $request->session()->put('type', 'admin');
                return redirect('main/adminpanel');
            } else if ($type_u == "employee") {
                $request->session()->put('type', 'employee');
                return redirect('main/employeepanel');
            } else {
                $request->session()->put('type', 'client');
                return redirect('main/clientpanel');
            }
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    }



    function signup()
    {
        return view('signup');
    }

    function logout()
    {
        Auth::logout();
        session()->forget('data');
        return redirect('main');
    }

    function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type_user = 'client';

        $query = $user->save();

        if ($query) {
            return back()->with('success', 'You have been successfully registered');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    //---------------controller for employee----------------------
    function successloginE()
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');
        $d = \Carbon\Carbon::now();
        $day = $d->get('day');
        $month = $d->get('month');
        $year = $d->get('year');

        $dayemployee = DB::table('days')
                ->where('day', $day)
                ->where('month', $month)
                ->where('year', $year)
                ->first();
        Session::put('dayemployee', $dayemployee->id);
        $days = Day::all();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $barber = DB::table('users')->where('id', session()->get('iduser'))->first();
        Session::put('barberemployee', $barber->id);
        $bookings = DB::table('bookings')
                    ->where('idE', $barber->id)
                    ->where('idD', $dayemployee->id)
                    ->orderBy('index')
                    ->get();

        $services = Service::all();
        return view('employeepanel', compact('bookings','days', 'barber', 'barbers', 'services'));
    }

    function viewbookingemployee($day){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');
        Session::put('dayemployee', $day);

        $days = Day::all();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $barber = DB::table('users')->where('type_user', 'employee')->first();
        Session::put('barberadmin', $barber->id);
        $bookings = DB::table('bookings')
                    ->where('idE', $barber->id)
                    ->where('idD', $day)
                    ->orderBy('index')
                    ->get();
        $services = Service::all();
        return view('bookingpaneladmin', compact('bookings','days', 'barber', 'barbers', 'services'));
    }

    function bookingemployeedelete($booking){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');
        DB::delete('delete from bookings where id = ?', [$booking]);
        return back();
    }

    function calendaremployee(){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');
        $day = \Carbon\Carbon::now();
        $month = $day->month;
        $days = Day::where('month', 3)->get();
        return view('calendaremployee', compact('days'));
    }

    function viewbookingem($day){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');
        Session::put('dayemployee', $day);

        $days = Day::all();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $barber = DB::table('users')
                ->where('type_user', 'employee')
                ->where('id', session()->get('iduser'))
                ->first();
        Session::put('barberadmin', $barber->id);
        $bookings = DB::table('bookings')
                    ->where('idE', $barber->id)
                    ->where('idD', $day)
                    ->orderBy('index')
                    ->get();
        $services = Service::all();
        return view('bookingpanelemployee', compact('bookings','days', 'barber', 'barbers', 'services'));
    }

    function viewhourem($day){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'employee')
            return redirect('main');

        Session::put('dayemployee', $day);

        $service = DB::table('services')->first();
        $services = Service::all();
        $barber = DB::table('users')
                    ->where('type_user', 'employee')
                    ->where('id', session()->get('iduser'))
                    ->first();
        Session::put('barberemployee', $barber->id);
        Session::put('serviceemployee', $service->id);
        $bookings = DB::table('bookings')
                ->where('idD', '=', $day)
                ->where('idE', '=', $barber->id)
                ->get();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $time = DB::table('services')->select('Id','time')->get();
        return view('hourpanelemployee', compact('bookings', 'time', 'barber', 'barbers', 'service', 'services'));
    }

    function bookinghouremployee($hour){
        if (!session()->has('data'))
            return redirect('main');
        Session::put('hour', $hour);
        $booking = new Booking();
        $booking->idD = session()->get('dayemployee');
        $booking->idE = session()->get('barberemployee');
        $booking->idS = session()->get('serviceemployee');
        $booking->idC = session()->get('iduser');
        $booking->index = session()->get('hour');//index
        $query = $booking->save();

        if ($query) {
            return back()->with('success', 'You have been successfully booking');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    //-------------------------------------------------------------
    //---------------controller for client-------------------------
    function successloginC()
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'client')
            return redirect('main');
        $employees = User::where('type_user', 'employee')->get();

        return view('choicebarber', ['employees' => $employees]);
    }

    function mybooking(){
        if (!session()->has('data'))
            return redirect('main');
        $idc = session()->get('iduser');
        $mybookings = DB::table('bookings')
                    ->where('idC', $idc)
                    ->orderBy('idD')->get();
        $services = Service::all();
        $days = Day::all();
        return view('mybooking', compact('mybookings', 'days', 'services'));
    }

    function choiceService($employee)
    {
        if (!session()->has('data'))
            return redirect('main');

        Session::put('barber', $employee);
        $services = Service::all();
        return view('choiceService', ['services' => $services]);
    }

    function calendar($service)
    {
        if (!session()->has('data'))
            return redirect('main');
        $day = \Carbon\Carbon::now();
        $month = $day->month;
        Session::put('service', $service);
        $servicechoice = session()->get('service');
        $days = Day::where('month', 3)->get();
        return view('calendar', compact('days', 'servicechoice'));
    }

    function choicehour($day){
        if (!session()->has('data'))
            return redirect('main');
        Session::put('day', $day);
        $barber = session()->get('barber');
        $bookings = DB::table('bookings')
                ->where('idD', '=', $day)
                ->where('idE', '=', $barber)
                ->get();

        $time = DB::table('services')->select('Id','time')->get();
        return view('hourpanel', compact('bookings', 'time'));
    }


    function bookingdelete($booking){
        if (!session()->has('data'))
            return redirect('main');

        DB::delete('delete from bookings where id = ?', [$booking]);
        return redirect()->back();
    }

    function bookinghour($hour){
        if (!session()->has('data'))
            return redirect('main');
        Session::put('hour', $hour);
        $booking = new Booking();
        $booking->idD = session()->get('day');
        $booking->idE = session()->get('barber');
        $booking->idS = session()->get('service');
        $booking->idC = session()->get('iduser');
        $booking->index = session()->get('hour');//index
        $query = $booking->save();

        if ($query) {
            return back()->with('success', 'You have been successfully booking');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    //------------------------------------------------------------

    //---------------controller for admin-------------------------
    function successloginA()
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $employees = User::where('type_user', 'employee')->get();
        $users = User::where('type_user', 'client')->get();
        $services = Service::all();

        return view(
            'adminpanel',
            compact('employees', 'services', 'users')
        );
    }

    function calendaradmin(){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $day = \Carbon\Carbon::now();
        $month = $day->month;
        $days = Day::where('month', 3)->get();
        return view('calendaradmin', compact('days'));
    }

    function addemployee(Request $request)
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $user = User::findOrFail($request->user);
        $user->type_user = 'employee';
        $user->update();

        return redirect()->back();
    }

    function viewhouradmin($day){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');

        Session::put('dayadmin', $day);

        $service = DB::table('services')->first();
        $services = Service::all();
        $barber = DB::table('users')->where('type_user', 'employee')->first();
        Session::put('barberadmin', $barber->id);
        Session::put('serviceadmin', $service->id);
        $bookings = DB::table('bookings')
                ->where('idD', '=', $day)
                ->where('idE', '=', $barber->id)
                ->get();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $time = DB::table('services')->select('Id','time')->get();
        return view('hourpaneladmin', compact('bookings', 'time', 'barber', 'barbers', 'service', 'services'));
    }

    function changebarber($barberid){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $day = session()->get('dayadmin');

        Session::put('barberadmin', $barberid);
        $service = DB::table('services')->first();
        $services = Service::all();
        //echo $barberid;
        $barber = DB::table('users')->where('type_user', 'employee')->where('id', $barberid)->first();
        $bookings = DB::table('bookings')
                ->where('idD', '=', $day)
                ->where('idE', '=', $barberid)
                ->get();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $time = DB::table('services')->select('Id','time')->get();
        return view('hourpaneladmin', compact('bookings', 'time', 'barber', 'barbers', 'service', 'services'));
    }

    function viewbookingadmin($day){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        Session::put('dayadmin', $day);

        $days = Day::all();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $barber = DB::table('users')->where('type_user', 'employee')->first();
        Session::put('barberadmin', $barber->id);
        $bookings = DB::table('bookings')
                    ->where('idE', $barber->id)
                    ->where('idD', $day)
                    ->orderBy('index')
                    ->get();
        $services = Service::all();
        return view('bookingpaneladmin', compact('bookings','days', 'barber', 'barbers', 'services'));
    }

    function changebarberbooking($barberid){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $day = session()->get('dayadmin');
        Session::put('barberadmin', $barberid);
        $days = Day::all();
        $services = Service::all();
        $barber = DB::table('users')->where('type_user', 'employee')->where('id', $barberid)->first();

        $bookings = DB::table('bookings')
                ->where('idD', '=', $day)
                ->where('idE', '=', $barberid)
                ->get();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        return view('bookingpaneladmin', compact('bookings', 'days', 'barber', 'barbers', 'services'));
    }


    function bookingadmindelete($booking){

        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        DB::delete('delete from bookings where id = ?', [$booking]);
        return redirect()->route('admin.viewbooking', ['day' => session()->get('dayadmin')]);
    }

    function bookinghouradmin($hour){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        Session::put('hour', $hour);
        $booking = new Booking();
        $booking->idD = session()->get('dayadmin');
        $booking->idE = session()->get('barberadmin');
        $booking->idS = session()->get('serviceadmin');
        $booking->idC = session()->get('iduser');
        $booking->index = session()->get('hour');//index
        $query = $booking->save();

        if ($query) {
            return back()->with('success', 'You have been successfully booking');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    function bookingtoday(){
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');
        $d = \Carbon\Carbon::now();
        $day = $d->get('day');
        $month = $d->get('month');
        $year = $d->get('year');

        $dayadmin = DB::table('days')
                ->where('day', $day)
                ->where('month', $month)
                ->where('year', $year)
                ->first();

        Session::put('dayadmin', $dayadmin->id);

        $days = Day::all();
        $barbers = DB::table('users')->where('type_user', 'employee')->get();
        $barber = DB::table('users')->where('type_user', 'employee')->first();
        Session::put('barberadmin', $barber->id);
        $bookings = DB::table('bookings')
                    ->where('idE', $barber->id)
                    ->where('idD', $day)
                    ->orderBy('index')
                    ->get();
        $services = Service::all();
        return view('bookingpaneladmin', compact('bookings','days', 'barber', 'barbers', 'services'));
    }


    function addservice(Request $request)
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');

        $service = new Service();
        $service->name = $request->name;
        $service->time = $request->time;
        $query = $service->save();

        if ($query) {
            return back()->with('success', 'You have been successfully created service');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    function delete($user)
    {   if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');

        DB::delete('delete from users where id = ?', [$user]);
        return redirect()->back();
    }

    function deleteservice($service)
    {
        if (!session()->has('data') && !session()->has('type'))
            return redirect('main');
        $type = session()->get('type');
        if ($type != 'admin')
            return redirect('main');

        DB::delete('delete from services where id = ?', [$service]);
        return redirect()->back();
    }
    //---------------------------------------------------


}
