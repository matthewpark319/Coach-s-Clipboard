<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Coach's Clipboard</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style>
    @import url('https://fonts.googleapis.com/css?family=Droid+Sans|Ubuntu|Asap');

    body {
        font-family:"Ubuntu";
    }
    </style>
</head>
<body id="login-body">
    <div class="header">
        <h1 class="heading">Coach's Clipboard</h1>
        
        <div class="header-container">
            <div class="vertical-center">
                <a class="header-link" href="{{ route('login') }}">
                    Login
                </a>
            </div>

            <div class="vertical-center">
                <a class="header-link" href="{{ route('register') }}">
                    Register
                </a>
            </div>
        </div>
    </div>

    <div id="login-header" class="container">
        <h2 style="text-align:center">Welcome to Coach's Clipboard.</h2>
    </div>
    @yield('content')


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
