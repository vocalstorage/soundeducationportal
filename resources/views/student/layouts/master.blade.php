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

<body @if(!\Auth::check()) class="body-login" @endif>
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



<script src="/js/app.js"></script>
<script src="/js/student/javascript.js"></script>
</body>
</html>