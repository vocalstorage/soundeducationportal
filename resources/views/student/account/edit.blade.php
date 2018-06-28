@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Bewerk account</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <form class="col s12" action="{{route('student-update')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s12">
                    <input value="{{old('name') ? old('name') : \Auth::user()->name}}"  id="first_name" type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}" name="name">
                    <label for="first_name">Naam</label>
                    @if ($errors->has('name'))
                        <span class="helper-text" data-error="{{ $errors->first('name') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input value="{{old('email') ? old('email') : \Auth::user()->email}}" id="email" type="email" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email">
                    <label for="email">Email</label>
                @if ($errors->has('email'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col l6 s12">
                    <input id="password_reg" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password" >
                    <label for="password_reg">Wachtwoord</label>
                    @if ($errors->has('password'))
                        <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                    @endif
                </div>
                <div class="input-field col l6 s12">
                    <input id="password_confirm_reg" type="password" class="validate" name="password_confirmation" >
                    <label for="password_confirm_reg">Wachtwoord bevestiging</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn  waves-effect show-swal-loading" data-message="Account aan het aanpassen" type="submit" name="action">Opslaan

                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(!empty($succes_msg))
        <div class="succes-msg" data-message="{{$succes_msg}}" style="display: none"></div>
    @endif
@endsection