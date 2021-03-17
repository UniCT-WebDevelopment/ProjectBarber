<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="assets/css/style-choiceBarber.css" media="screen"/>-->
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-choiceBarber.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-calendar.css') }}" >
    <title>Scegli il tuo Barber</title>
</head>
<body>
    <div class="panel">
        <div class="main-panel">
            <table class="table-barber">
                <tr>
                    <th class="title-table" colspan="3">Scegli il tuo Barber!</th>
                </tr>

                @foreach($employees as $employee)
                <form method="get" action="{{route('employees.choiceservice', $employee->id)}}">
                    @csrf
                    <tr>
                        <td class="icon-poltron" name="idbarber"><button type="submit" class="btn-poltron"><img class="icon" src="{{ asset('./assets/icon/new/2214905-barber/svg/007-barber chair.svg')}}"></button></td>
                        <td class="name-barber">{{$employee->name}}{{$employee->surname}}</td>
                    </tr>
                </form>
                @endforeach

            </table>
        </div>
        <div class="fixed-bar">
            <table class="table-bar">
                <tr>
                    <th class="th-bar active">
                        <a href="{{url('/main/clientpanel')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/new/2214905-barber/svg/007-barber chair.svg')}}" >
                        <div class="voice-menu">Prenota adesso</div></a>
                    </th>
                    <th class="th-bar">
                        <a href="{{url('/main/mybooking')}}"><img class="icon-bar" src="{{ asset('./assets/icon/new/2214905-barber/svg/agenda.svg')}}" >
                        <div class="voice-menu">Le tue prenotazioni</div></a>
                    </th>
                    <th class="th-bar">
                        <a href="{{url('/main/logout')}}"><img class="icon-bar" src="{{ asset('./assets/icon/new/2214905-barber/svg/020-push-button.svg')}}" >
                        <div class="voice-menu">Logout</div></a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
