@extends('student.layouts.master')

@section('content')
    <div class="z-depth-3 white">
        <div class="row">
            <div class="col s12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-panel green lighten-1" style="margin: 0px">
                   <h5 style="margin: 0px"><span class="white-text" >Reset password</span></h5>
                </div>
                <br>
                <form method="POST" action="{{ route('password.email') }}" class="col s12">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email_log" placeholder="email" type="text" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required>
                            <label for="email_log">Email</label>
                            @if ($errors->has('email'))
                                <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn  waves-effect green lighten-1 ">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
