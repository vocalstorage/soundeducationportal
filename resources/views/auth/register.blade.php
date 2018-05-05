@extends('student.layouts.master')

@section('content')
<div class="register z-depth-3 white">
    <div class="row">
        <div class="col s12">
            <nav class="green lighten-1 ">
                <div class="nav-wrapper">
                    <ul id="nav">
                        <li class="w-50 waves-effect"><a href="{{ route('login') }}"><span class="log_reg">Login</span></a></li>
                        <li class="w-50 waves-effect active" ><a href="{{ route('register') }}"><span class="log_reg">Register</span></a></li>
                    </ul>
                </div>
            </nav>
            <br>
            <form method="POST" action="{{ route('register') }}" class="col s12">
                {{--<div class="row">--}}
                    {{--<div class="col s12">--}}
                        {{--<h3>Register</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name_reg"  value="@if(old('name')){{old('name')}}@endif"  type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}" name="name" required>
                        <label for="name_reg">Name</label>
                        @if ($errors->has('name'))
                            <span class="helper-text" data-error="{{ $errors->first('name') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email_reg"  value="@if(old('email')){{old('email')}}@endif" type="email" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" required>
                        <label for="email_reg">Email</label>
                        @if ($errors->has('email'))
                            <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="password_reg" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>
                        <label for="password_reg">Password</label>
                        @if ($errors->has('password'))
                            <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s6">
                        <input id="password_confirm_reg" type="password" class="validate" name="password_confirmation" required>
                        <label for="password_confirm_reg">Password confirmation</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="license_key_reg" type="text"  class="validate  {{ $errors->has('license_key') ? ' invalid' : '' }}" name="license_key" required>
                        <label for="license_key_reg">License key</label>
                        @if ($errors->has('license_key'))
                            <span class="helper-text" data-error="{{ $errors->first('license_key') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="input-field">
                    <div class="col s8">
                        <button type="submit" class="btn  waves-effect green lighten-1 ">
                            Register
                        </button>
                    </div>
                </div>
                <a class="right" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </form>
        </div>
    </div>
</div>
@endsection

