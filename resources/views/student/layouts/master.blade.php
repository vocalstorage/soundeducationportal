<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320px, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Soundeducation Planner</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">

<body class="student">
@if(\Auth::check())
    @include('student.layouts.header')
@endif

@if(\Auth::check())
    <div class="page-wrapper">
        <div class="container animated fadeIn" id="dashboard_content">
            @yield('content')
        </div>
    </div>
@else

                    @yield('content')
@endif

<div class="dim-screen">
    @include('admin.includes.loader')
</div>

<script src="/js/app.js"></script>
<script src="/js/student/javascript.js"></script>
</body>
</html>