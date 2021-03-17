<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\MainController@index');

Route::get('/signup', 'App\Http\Controllers\MainController@signup');

Route::get('/main', 'App\Http\Controllers\MainController@index');

Route::post('/main/checklogin', 'App\Http\Controllers\MainController@checklogin');

Route::get('main/adminpanel', 'App\Http\Controllers\MainController@successloginA');

Route::get('main/calendaradmin', 'App\Http\Controllers\MainController@calendaradmin');

Route::get('main/calendaremployee', 'App\Http\Controllers\MainController@calendaremployee');

Route::get('main/employeepanel', 'App\Http\Controllers\MainController@successloginE');

Route::get('main/clientpanel', 'App\Http\Controllers\MainController@successloginC');

Route::get('main/logout', 'App\Http\Controllers\MainController@logout');

Route::get('main/mybooking', 'App\Http\Controllers\MainController@mybooking');

Route::get('main/bookingtoday', 'App\Http\Controllers\MainController@bookingtoday');

Route::get('/main/employees/{employee}',
    'App\Http\Controllers\MainController@choiceService'
)->name('employees.choiceservice');

Route::post('main/create', 'App\Http\Controllers\MainController@create');

Route::post('/main/adminpanel/addemployee', 'App\Http\Controllers\MainController@addemployee');

Route::post('/main/adminpanel/addservice', 'App\Http\Controllers\MainController@addservice');

Route::delete(
    '/main/users/{user}',
    'App\Http\Controllers\MainController@delete'
)->name('users.delete');

Route::delete(
    '/main/services/{service}',
    'App\Http\Controllers\MainController@deleteservice'
)->name('services.delete');

Route::get(
    '/main/services/{service}',
    'App\Http\Controllers\MainController@calendar'
)->name('services.calendar');

Route::get(
    '/main/days/{day}',
    'App\Http\Controllers\MainController@choicehour'
)->name('days.choicehour');

Route::get(
    '/main/hours/{hour}',
    'App\Http\Controllers\MainController@bookinghour'
)->name('hour.booking');

Route::get(
    '/main/mybooking/{booking}',
    'App\Http\Controllers\MainController@bookingdelete'
)->name('booking.delete');


Route::get(
    '/main/admin/booking/days/{day}',
    'App\Http\Controllers\MainController@viewbookingadmin'
)->name('admin.viewbooking');

Route::get(
    'main/admin/booking/{barberid}',
    'App\Http\Controllers\MainController@changebarberbooking'
)->name('barber.viewbooking');

Route::get(
    '/main/admin/bookings/{booking}',
    'App\Http\Controllers\MainController@bookingadmindelete'
)->name('bookingad.delete');

Route::get(
    '/main/admin/hours/{hour}',
    'App\Http\Controllers\MainController@bookinghouradmin'
)->name('hour.bookingadmin');


Route::get(
    '/main/admin/hour/days/{day}',
    'App\Http\Controllers\MainController@viewhouradmin'
)->name('admin.viewhour');

Route::get(
    'main/admin/{barberid}',
    'App\Http\Controllers\MainController@changebarber'
)->name('barber.viewhour');


Route::get(
    '/main/employee/bookings/{booking}',
    'App\Http\Controllers\MainController@bookingemployeedelete'
)->name('bookingem.delete');

Route::get(
    '/main/employee/booking/days/{day}',
    'App\Http\Controllers\MainController@viewbookingem'
)->name('employee.viewbooking');

Route::get(
    '/main/employee/hour/days/{day}',
    'App\Http\Controllers\MainController@viewhourem'
)->name('employee.viewhour');

Route::get(
    '/main/employee/hours/{hour}',
    'App\Http\Controllers\MainController@bookinghouremployee'
)->name('hour.bookingemployee');
