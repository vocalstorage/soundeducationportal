@extends('student.layouts.master')

@section('content')
    <div class="z-depth-3 white">
        <div class="row">
            <div class="col s12">
                <h3>Reset password</h3>
                <br>
                <form method="POST" action="{{ route('password.request') }}" class="col s12">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email_log" placeholder="email" type="text" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
                            <label for="email_log">Email</label>
                            @if ($errors->has('email'))
                                <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="password_log" placeholder="password" type="text" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="email" value="{{ $email or old('password') }}" required>
                            <label for="password_log">Email</label>
                            @if ($errors->has('password'))
                                <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="helper-text" data-error="{{ $errors->first('password_confirmation') }}"></span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn  waves-effect green lighten-1 ">
                        Reset password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
