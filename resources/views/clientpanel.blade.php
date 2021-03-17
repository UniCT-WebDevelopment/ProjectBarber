<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Panel</title>
</head>
<body>
    Client Panel
    <div>
        @if(isset(Auth::user()->email))
            <strong>Welcome {{ Auth::user()->email }}</strong>
            <a href="{{url('/main/logout')}}">logout</a>
        @else
            <script>window.location = "/main";</script>
        @endif
    </div>
</body>
</html>
