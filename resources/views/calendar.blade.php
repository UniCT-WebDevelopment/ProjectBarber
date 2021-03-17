<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-calendar.css') }}" media="screen">
    <!--<script type="text/javascript" src="{{ URL::asset('/assets/js/calendar.js') }}"></script>-->
    <title>Calendar</title>
</head>
<body style="background-color: gray">
    <div class="panel">
        <div class="calendar-div">
            <table id="calendar-table">
                <tr> <th colspan="7">2020</th></tr>
                <tr>
                    <th>LUN</th>
                    <th>MAR</th>
                    <th>MER</th>
                    <th>GIO</th>
                    <th>VEN</th>
                    <th>SAB</th>
                    <th>DOM</th>
                </tr>
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
    <script>

        var data = new Date();
        var year = data.getFullYear();
        var month = data.getMonth();
        var daycur = data.getDate();
        month++;

        var primo, controllo;
        var lun = mar = mer = gio = ven = sab = dom = [];
        var lun1 = mar1 = mer1 = gio1 = ven1 = sab1 = dom1 = [];
        var clun = cmar = cmer = cgio = cven = csab = cdom = 0;

        var days = {!! json_encode($days, JSON_HEX_TAG) !!};
        var servicechoice = {!! json_encode($servicechoice, JSON_HEX_TAG) !!};
        console.log(servicechoice);
        for (var day in days) {
            if (days.hasOwnProperty(day)) {
                if(days[day].day == 1){
                    primo = days[day].dweek;
                }
            /*if(days[day].dweek == 'Lun'){
                    lun[clun] = days[day].day;
                    lun1[clun] = days[day].id;
                    clun++;
                }else if(days[day].dweek == 'Mar'){
                    mar[cmar] = days[day].day;
                    mar1[cmar] = days[day].id;
                    cmar++;
                }else if(days[day].dweek == 'Mer'){
                    mer[cmer] = days[day].day;
                    mer1[cmer] = days[day].id;
                    cmer++;
                }else if(days[day].dweek == 'Gio'){
                    gio[cgio] = days[day].day;
                    gio1[cgio] = days[day].id;
                    cgio++;
                }else if(days[day].dweek == 'Ven'){
                    ven[cven] = days[day].day;
                    ven1[cven] = days[day].id;
                    cven++;
                }else if(days[day].dweek == 'Sab'){
                    sab[csab] = days[day].day;
                    sab1[csab] = days[day].id;
                    csab++;
                }else if(days[day].dweek == 'Dom'){
                    dom[cdom] = days[day].day;
                    dom1[cdom] = days[day].id;
                    cdom++;
                }*/
            }
        }

        var url;
        var tr;
        var tablecal = document.getElementById('calendar-table');
        var nweek = Math.ceil(days.length/7);
        var td = "";
        if(primo == "Lun" || primo == "Mar"){
            if(primo == "Mar")
                td += "<td></td>";
            for (var dd in days) {
                if(days[dd].day < daycur || days[dd].month < month || days[dd].dweek == 'Dom' || days[dd].dweek == 'Lun'){
                    td += "<td><button id="+days[dd].id+" type='submit' class='day-button' style='color: rgb(255, 127, 17, 0.4)' disabled>"+days[dd].day+"</button></td>";}
                else {url = '{{ route("days.choicehour", ":day") }}';
                    url = url.replace(':day', days[dd].id);
                    td += "<td><form action="+url+" method='get'><button id="+days[dd].id+" type='submit' class='day-button'>"+days[dd].day+"</button></form></td>";
                }

                if(days[dd].dweek == 'Dom'){
                    tr = document.createElement('tr');
                    tr.innerHTML = td;
                    tablecal.appendChild(tr);
                    td = "";
                }
            }
            tr = document.createElement('tr');
            tr.innerHTML = td;
            tablecal.appendChild(tr);
            td = "";
        }

        var monthtr = document.createElement('tr');
        monthtr.innerHTML = '<td class="back" colspan="2"><img src="{{ asset('./assets/icon/left_arrow.png')}}"></td><th class="month" colspan="3">Marzo</th><td class="next" colspan="2"><img src="{{ asset('./assets/icon/right_arrow.png')}}"></td>';
        tablecal.appendChild(monthtr);

        /*function choiceday(id){
            $.get('days.choicehour', { day : id })
            .done(function(data){
                alert("Data loaded:" +data);
            })
            .fail(function(){
                alert("Error");
            });
        }*/
    </script>
</body>
</html>
