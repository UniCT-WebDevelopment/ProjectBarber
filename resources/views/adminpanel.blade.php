<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-admin.css') }}" >
    <title>Admin Panel</title>

</head>
<body>
    <div class="admin-panel">
        <div class="list-employee">
            <table class="table-employee">
                <tr>
                    <th class="title-table" colspan="3">Employee</th>
                </tr>
                    @foreach($employees as $employee)
                        <tr>
                            <form action="{{route('users.delete',$employee->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <td class="icon-poltron"><img class="icon" src="{{ asset('./assets/icon/new/2214905-barber/svg/007-barber chair.svg')}}"></td>
                                <td class="name-barber">{{$employee->name}} {{$employee->surname}} {{$employee->email}}</td>
                                <td class="icon-poltron"><button class="btn-delete" type="submit"><img class="icon-delete" src="{{asset('./assets/icon/new/2214905-barber/svg/delete.svg')}}"></button></td>
                            </form>
                        </tr>
                    @endforeach
                <tr>
                    <td colspan="3" class="icon-td-add" onclick="formdisplay()"><img class="icon-to-add" src="{{ asset('./assets/icon/new/2214905-barber/svg/friendly.svg')}}"></td>
                </tr>
            </table>
            <div class="form-to-add-barber" id="ftab">
                <form action="{{url('/main/adminpanel/addemployee')}}" method="post">
                    @csrf
                    <select class="opt" name="user">
                        <option value="0">Choice Employee:</option>
                        @foreach($users as $user)
                            <option name="user" value="{{$user->id}}">{{$user->name}} {{$user->surname}} {{$user->email}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="a-add-employee">Add</button>
                </form>
            </div>
        </div>

        <div class="list-service">
            <table class="table-service">
                <tr>
                    <th class="title-service" colspan="3">Service</th>
                </tr>
                @foreach($services as $service)
                    <tr>
                        <form action="{{route('services.delete',$service->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <td class="icon-poltron"><img class="icon" src="{{ asset('./assets/icon/new/2214905-barber/svg/004-barber pole.svg')}}"></td>
                            <td class="name-service">{{$service->name}} - {{$service->time}} min.</td>
                            <td class="icon-poltron"><button class="btn-delete" type="submit"><img class="icon-delete" src="{{asset('./assets/icon/new/2214905-barber/svg/delete.svg')}}"></button></td>
                        </form>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="icon-td-add" onclick="formservicedisplay()"><img class="icon-to-add" src="{{ asset('./assets/icon/new/2214905-barber/svg/004-barber pole.svg')}}"></td>
                </tr>
            </table>
            <div class="form-to-add-barber" id="ftas">
                <form action="{{url('/main/adminpanel/addservice')}}" method="post">
                    @csrf
                    <div>
                        @if(Session::get('success'))
                            <div style="color:rgb(60, 255, 0); text-align:center">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::get('fail'))
                            <div style="color:rgb(255, 0, 0) text-align:center">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                    </div>
                    <input type="text" name="name" class="add-service-name" placeholder="name of service">
                    <input type="number" name="time" class="add-service-min" placeholder="minutes">
                    <button type="submit" class="a-add-service">Add Service</button>
                </form>
            </div>
        </div>
        <div class="fixed-bar">
            <table class="table-bar">
                <tr>
                    <th class="th-bar active">
                        <a href="{{url('/main/adminpanel')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/933159-time/svg/008-clipboard.svg') }}" >
                        <div class="voice-menu">Admin Panel</div></a>
                    </th>
                    <th class="th-bar">
                        <a href="{{url('/main/calendaradmin')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/933159-time/svg/011-calendar.svg')}}" >
                        <div class="voice-menu">Calendar</div></a>
                    </th>
                    <th class="th-bar">
                        <a href="{{url('/main/bookingtoday')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/933159-time/svg/013-24-hours.svg')}}" >
                        <div class="voice-menu">BookingToday</div></a>
                    </th>
                    <th class="th-bar">
                        <a href="{{url('/main/logout')}}"><img class="icon-bar" src="{{ asset('./assets/icon/new/2214905-barber/svg/020-push-button.svg')}}" >
                        <div class="voice-menu">Logout</div></a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <script>
    function formdisplay(){
        var ftab = document.getElementsByClassName("form-to-add-barber")[0];
        var style = getComputedStyle(ftab);
        console.log(style.display);
        if(style.display != "none")
            ftab.style.display = "none";
        else ftab.style.display = "inline";
    }

    function formservicedisplay(){
        var ftas = document.getElementsByClassName("form-to-add-barber")[1];
        var styles = getComputedStyle(ftas);
        console.log(styles.display);
        if(styles.display != "none")
            ftas.style.display = "none";
        else ftas.style.display = "inline";
    }
    </script>

</body>
</html>
