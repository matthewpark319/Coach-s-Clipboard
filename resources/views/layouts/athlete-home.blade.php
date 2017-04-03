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
                    <li id="home"><a href="{{ route('athlete-home') }}">Home</a></li>
                    <li id="my_profile"><a href="{{ route('my-profile') }}">My Profile</a></li>
                    <li id="roster"><a href="{{ route('athlete-roster') }}">Roster</a></li>
                    <li id="schedule"><a href="{{ route('athlete-schedule') }}">Schedule</a></li>
                    <li id="results"><a href="#">Results</a></li>
                    <li id="announcements"><a href="{{ route('athlete-announcements') }}">Announcements</a></li>
                    <li id="account-title"><a>Athlete Account: {{ $user->first_name . ' ' . $user->last_name }}</a></li>
                </ul>
            </div>
            <div class="navbar-filler"></div>
        </div>
        @yield('content')

        <script>
            $(document).ready(function(){
                var view = "{{ $view }}";
                if (view.localeCompare("athlete.home") == 0)
                    $('#home').attr('class', 'active');
                else if (view.localeCompare('athlete.roster') == 0 || view.localeCompare('athlete.view-athlete') == 0)
                    $('#roster').attr('class', 'active'); 
                else if (view.localeCompare('athlete.schedule') == 0)
                    $('#schedule').attr('class', 'active');
                else if (view.localeCompare('athlete.announcements') == 0 || view.localeCompare('athlete.add-announcement') == 0)
                    $('#announcements').attr('class', 'active');
            });   
        </script>
    </body>
</html>