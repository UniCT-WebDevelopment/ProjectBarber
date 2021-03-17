<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="assets/css/style-registrati.css" media="screen" />-->
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-registrati.css') }}" >
    <title>Registrazione</title>
</head>
<body>
    <div class="div-image">
        <div class="panel">
            <div class="regis-title">
                Registrazione
            </div>
            <div class="regis-div">
                <div class="input-div">
                    <form action="{{url('/main/create')}}" method="post">
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
                        <input type="text" class="input-field-name" name="name" placeholder="Name">
                        <input type="text" class="input-field-surname" name="surname" placeholder="Surname">
                        <input type="text" class="input-field-telephone" name="telephone" placeholder="Telephone">
                        <input type="text" class="input-field" name="email" placeholder="Email">
                        <input type="password" class="input-field" name="password" placeholder="Password">
                        <button type="submit" class="regis-btn">
                            Registrati
                        </button>
                    </form>
                    <button onclick="window.location='/main'"class="login-btn">
                        Login
                    </button>
                </div>
            </div>
        </div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/good-ware" title="Good Ware">Good Ware</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
    </div>
</body>
</html>
