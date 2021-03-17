<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/style-login.css" media="screen" />-->
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/style-login.css') }}" >
    <title>Login</title>
</head>
<body>
    <div class="div-image">
        <div class="panel">
            <div class="login-title">
                Login
            </div>
            <div class="login-div">
                <div style="text-align:center; color: red">
                @if($message = Session::get('error'))
                    <button type="button" data-dismiss="alert">x</button>
                    <strong> {{ $message }}</strong>
                @endif

                @if(count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li color="red">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                </div>
                <div class="input-div">
                    <form action="{{url('/main/checklogin')}}" method="post">
                        @csrf
                        <input type="text" name="email" class="input-field" placeholder="Email">
                        <input type="password" name="password" class="input-field" placeholder="Password"">
                        <button type="submit" class="login-btn">
                            Login
                        </button>
                    </form>
                        <button onclick="window.location='/signup'" class="regis-btn">
                            Registrati
                        </button>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
