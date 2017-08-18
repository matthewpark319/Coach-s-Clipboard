<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>

    <body>
        <div class="header">
            <h1 class="heading">Coach's Clipboard</h1>
            <div class="header-container">
                <h3 class="logout-header float-bottom">Hello, {{ $user->first_name }}</h3>
                <div class="vertical-center">
                    <a href="{{ route('logout') }}">
                        <button type="button" class="btn btn-primary logout-button">Log Out</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-wrapper">
            <div class="navbar-container">
                <ul class="nav nav-tabs">
                    <li id="home"><a href="{{ route('coach-home') }}">Home</a></li>
                    <li id="roster"><a href="{{ route('coach-roster') }}">Team</a></li>
                    <li id="schedule"><a href="{{ route('coach-schedule') }}">Schedule</a></li>
                    <li id="results"><a href="{{ route('coach-results') }}">Results</a></li>
                    <li id="announcements"><a href="{{ route('coach-announcements') }}">Announcements</a></li>
                    <li id="account-title"><a>Coach Account: {{ $coach->title }}</a></li>
                </ul>
            </div>
            <div class="navbar-filler"></div>
        </div>
        @yield('content')

        <script>
            $(document).ready(function(){
                if ({{ $tab }} == 0) $('#home').attr('class', 'active');
                else if ({{ $tab }} == 1) $('#roster').attr('class', 'active'); 
                else if ({{ $tab }} == 2) $('#schedule').attr('class', 'active');
                else if ({{ $tab }} == 3) $('#results').attr('class', 'active');
                else if ({{ $tab }} == 4) $('#announcements').attr('class', 'active'); 
            });   

            function changeSeason(route) {
                var season = $('#season option:selected').val();
                window.location.href = "/coach/" + route + "/" + season;
            }
        </script>
    </body>
</html>