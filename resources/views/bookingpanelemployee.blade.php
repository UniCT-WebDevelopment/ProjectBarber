<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-mybooking.css') }}" media="screen">

    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
    <title>My Boking</title>
</head>
<body style="background-color: gray">
    <div class="panel">
        <div class="bookings-div">
            <table id="bookings-table">

            </table>
        </div>
        <div class="fixed-bar">
            <table class="table-bar">
                <tr>
                    <th class="th-bar">
                        <a href="{{url('/main/employeepanel')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/933159-time/svg/008-clipboard.svg') }}" >
                        <div class="voice-menu">Employee Panel</div></a>
                    </th>
                    <th class="th-bar active">
                        <a href="{{url('/main/calendaremployee')}}">
                        <img class="icon-bar" src="{{ asset('./assets/icon/933159-time/svg/011-calendar.svg')}}" >
                        <div class="voice-menu">Calendar</div></a>
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
        var td = "";
        var url, url3;
        var bookings = {!! json_encode($bookings, JSON_HEX_TAG) !!};
        var services = {!! json_encode($services, JSON_HEX_TAG) !!};
        var barber = {!! json_encode($barber, JSON_HEX_TAG) !!};
        var barbers = {!! json_encode($barbers, JSON_HEX_TAG) !!};
        var days = {!! json_encode($days, JSON_HEX_TAG) !!};
        var tablebookings = document.getElementById('bookings-table');
        var title = "";
        var html = "";
        title = "<th colspan='5'>"+barber.name+"</th>";
        var barbern = document.createElement('tr');
        barbern.innerHTML = title;
        tablebookings.appendChild(barbern);
        title = "";

        if(bookings.length == 0){
                console.log("0");
                td += "<td>Non ci sono prenotazioni!</td>";
                var tr = document.createElement('tr');
                tr.innerHTML = td;
                tablebookings.appendChild(tr);
                td = "";

        }else{
            for(var bb in bookings){
                for(var i = 0; i < days.length; i++)
                    if({{Session::get('dayemployee')}} == days[i].id)
                        td += "<td class='date-booking'>"+days[i].day+"/"+days[i].month+"/"+days[i].year+"</td>";
                td += "<td class='hour-booking'>"+calcolaOrario(bookings[bb].index)+"</td>";
                for(var i = 0; i < services.length; i++)
                    if(bookings[bb].idS == services[i].id)
                        td += "<td class='service-booking'>"+services[i].name+"</td>";

                url = '{{route("bookingem.delete", ":booking") }}';
                url = url.replace(':booking', bookings[bb].id);
                td += "<td class='delete-booking'><form action="+url+" method='get'><button type='submit' class='btn-delete'><img class='icon-bar' src={{ asset('./assets/icon/new/2214905-barber/svg/delete.svg')}}></button></form></td>";
                var tr = document.createElement('tr');
                tr.innerHTML = td;
                tablebookings.appendChild(tr);
                td = "";
            }
        }



        function calcolaOrario(tmp)//gli passiamo l'indice dell'orario trovato libero
        {
            var stringa;
            var orario= tmp * 5;//cosi troviamo i minuti di distacco dalle 09(o orario apertura) all'orario trovato libero
            var count = 0;
            while (orario >= 60)//fin quando ci sono 60 minuti da togliere
            {
                orario-=60;//togli 60 minuti
                count++;//e aggiungi un'ora
            }
            count+=9;//in count avremmo le ore di distacco dalle 8 all'orario trovato libero, infatti sommiamo 8 per risalire a l'ora esatta
            if(count >= 12)
                count += 2;
            if(orario == 0){
                if(count == 9)
                    stringa= "0"+count+":"+orario+"0";
                else stringa= count+":"+orario+"0";
            }
            else {
                if(count == 9)
                    stringa= "0"+count+":"+orario;
                else stringa= count+":"+orario;
            }//nella var orario ci resteranno i minuti che saranno per certo < di 60 e quindi concateniamo all'ora esatta trovata sopra. fine
            return stringa;
        }
    </script>
</body>
</html>
