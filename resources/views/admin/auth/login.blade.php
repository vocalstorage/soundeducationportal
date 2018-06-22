@extends('teacher.layouts.master')
@section('content')
    <div class="login-wrapper ">
        <div class="logo">
            <img src="//static1.squarespace.com/static/555f4c1ce4b0c32dcc3c12e4/t/5582b255e4b00d5e96225f5a/1527848374125/?format=200w"
                 alt="">
        </div>
        <div class="col s12">
            <div class="logo-text">
                <h1>Admin login</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('admin-login-submit') }}" class="col s12">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix material-icons-green">email</i>
                    <input id="email_log" placeholder="email" type="text" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email">
                    <label for="email_log">Email</label>
                    @if ($errors->has('email'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix material-icons-green">lock</i>
                    <input id="password_log" placeholder="password" id="password" type="password"
                           class="validate {{ $errors->has('password') ? ' invalid' : '' }}"
                           name="password">
                    <label for="password_log">Password</label>
                    @if ($errors->has('password'))
                        <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                    @endif
                </div>
            </div>
            <div class="input-field">
                <div class="col s12">
                    <button type="submit" class="btn  waves-effect  col s12">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection


