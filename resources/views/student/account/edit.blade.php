@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Bewerk account</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <form class="col s12" action="{{route('student-update')}}">
            <div class="row">
                <div class="input-field col s12">

                    <input value=" @if(old('name')){{old('name')}} @else {{\Auth::user()->name}} @endif" placeholder="Placeholder" id="first_name" type="text" class="validate" name="name">
                    <label for="first_name">Naam</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input value="@if(old('email')){{old('email')}} @else {{\Auth::user()->email}} @endif" id="email" type="email" class="validate" name="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn  waves-effect green lighten-1" type="submit" name="action">Opslaan
                        <i class="material-icons right" style="color:white">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection