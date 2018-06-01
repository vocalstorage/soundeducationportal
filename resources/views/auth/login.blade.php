@extends('student.layouts.master')
@section('content')
<div class="z-depth-3 white">
    <div class="row">
        <div class="col s12">
            <nav class="green lighten-1 ">
                <div class="nav-wrapper">
                    <ul id="nav">
                        <li class="w-50 waves-effect active"><a href="{{ route('login') }}"><span class="log_reg">Login</span></a></li>
                        <li class="w-50 waves-effect" ><a href="{{ route('register') }}"><span class="log_reg">Register</span></a></li>
                    </ul>
                </div>
            </nav>
            <br>
            <form method="POST" action="{{ route('login') }}" class="col s12">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email_log" placeholder="email" type="text"
                               class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email">
                        <label for="email_log">Email</label>
                        @if ($errors->has('email'))
                            <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password_log" placeholder="password" id="password" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password">
                        <label for="password_log">Password</label>
                        @if ($errors->has('password'))
                            <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="input-field">
                    <div class="col s12">
                        <button type="submit" class="btn  waves-effect green lighten-1 ">
                            Login
                        </button>

                        <a class="right" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


