@extends('student.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="logo">
                    <img src="//static1.squarespace.com/static/555f4c1ce4b0c32dcc3c12e4/t/5582b255e4b00d5e96225f5a/1527848374125/?format=200w"
                         alt="">
                </div>
                <div class="col s12">
                    <div class="logo-text">
                        <h1>Sound education scheduler</h1>
                    </div>
                </div>
                <form method="POST" action="{{ route('password.request') }}" class="col s12">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email_log" type="text"
                                   class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                                   value="{{ $email or old('email') }}" required autofocus>
                            <label for="email_log">Email</label>
                            @if ($errors->has('email'))
                                <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                            @endif
                        </div>


                        <div class="input-field col s6">
                            <input id="password_log" type="password"
                                   class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password"
                                   value="{{ $email or old('password') }}" required>
                            <label for="password_log">Nieuw wachtwoord</label>
                            @if ($errors->has('password'))
                                <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                            @endif
                        </div>

                        <div class="input-field col s6">
                                <input id="password_confirm" type="password"
                                       class="validate {{ $errors->has('password_confirmation') ? ' invalid' : '' }}"
                                       name="password_confirmation" required>
                                <label for="password_confirm">Herhaal wachtwoord</label>

                                @if ($errors->has('password_confirmation'))
                                    <span class="helper-text"
                                          data-error="{{ $errors->first('password_confirmation') }}"></span>
                                @endif
                        </div>
                        <button type="submit" class="btn  waves-effect green lighten-1  col s12">
                            Herstel wacthwoord
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
