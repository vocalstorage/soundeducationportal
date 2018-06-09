<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/trumbowyg.min.css">
    <link rel="stylesheet" href="/css/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/lesson.css">

<body>
@if(\Auth::check())
    @include('teacher.layouts.header')
        <div class="col s12">
            <div class="container" id="dashboard_content">
                @yield('content')
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="welcome_wrapper" style="margin-top: 5%">
            <div class="col s12">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

@endif

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="/js/materialize.min.js"></script>
<script src="/js/trumbowyg.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.17.0/dist/sweetalert2.all.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/teacher/javascript.js"></script>


</body>
</html>