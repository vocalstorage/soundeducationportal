<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Template for Bootstrap</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">

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
<script src="/js/app.js"></script>
<script src="/js/standalones.js"></script>
<script src="/js/teacher/javascript.js"></script>



</body>
</html>