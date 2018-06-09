<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Template for Bootstrap</title>

    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/student/stylesheet.css">

<body @if(!\Auth::check()) class="body-login" @endif>
@if(\Auth::check())
    @include('student.layouts.header')
@endif
<div class="row">
    @if(\Auth::check())
        <div class="col s12">
            <div class="container" id="dashboard_content">
                @yield('content')
            </div>
        </div>
    @else
        @yield('content')
    @endif
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.17.0/dist/sweetalert2.all.js"></script>
<script src="/js/materialize.min.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/fullcalendar.min.js"></script>
<script src="/js/student/javascript.js"></script>
</body>
</html>