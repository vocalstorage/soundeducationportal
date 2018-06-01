@extends('teacher.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
           <h1 class="h2 ">Edit</h1>
        </div>
    </div>
    @include('teacher.layouts.errors')
    <div class="row">
        <form class="col s12" action="{{route('teacher-update')}}">
            <div class="row">
                <div class="input-field col s12">

                    <input value=" @if(old('name')){{old('name')}} @else {{\Auth::user()->name}} @endif" placeholder="Placeholder" id="first_name" type="text" class="validate" name="name">
                    <label for="first_name">First Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input value="@if(old('email')){{old('email')}} @else {{\Auth::user()->email}} @endif" id="email" type="email" class="validate" name="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn  waves-effect green lighten-1" type="submit" name="action">Save
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection