@extends('student.layouts.master')

@section('content')
    <div class="login-wrapper">
        <div class="logo">
            <img src="/img/logo.png" alt="logo" class="responsive-img img-logo">
        </div>
        <div class="logo-text">
            <h1>SOUND EDUCATION PLANNER (OLD)</h1>
        </div>
        <div class="login-form-wrapper">
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix ">email</i>
                            <input id="email_log" type="text"
                                   class="validate {{ $errors->has('email') ? ' invalid' : '' }}"
                                   name="email">
                            <label for="email_log">Email</label>
                            @if ($errors->has('email'))
                                <span class="helper-text"
                                      data-error="{{ $errors->first('email') }}"></span>
                            @endif
                        </div>

                        <div class="input-field col s12">
                            <i class="material-icons  prefix">lock</i>
                            <input id="password_log" id="password" type="password"
                                   class="validate {{ $errors->has('password') ? ' invalid' : '' }}"
                                   name="password">
                            <label for="password_log">Wachtwoord</label>
                            @if ($errors->has('password'))
                                <span class="helper-text"
                                      data-error="{{ $errors->first('password') }}"></span>
                            @endif
                        </div>

                        <div class="input-field col s12">
                            <button type="submit" class="btn  waves-effect   col s12">
                                Inloggen
                            </button>
                        </div>
                    </div>
                    <a class="right" href="{{ route('password.request') }}">
                        Wachtwoord vergeten?
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection


