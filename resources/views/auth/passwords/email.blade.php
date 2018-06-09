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
                        <h1>Wacthwoord vergeten</h1>
                    </div>
                </div>
                <div class="col s12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form method="POST" action="{{ route('password.email') }}" class="col s12">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input id="email_log" placeholder="email" type="text"
                                       class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                                       value="{{ $email or old('email') }}" required>
                                <label for="email_log">Email</label>
                                @if ($errors->has('email'))
                                    <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn  waves-effect green lighten-1 col s12">
                            Verzend
                        </button>
                    </form>
                </div>
                <div class="col s12">
                    <a href="{{route('login')}}"><i class="material-icons prefix">arrow_back</i>
                        Terug naar login pagina
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
