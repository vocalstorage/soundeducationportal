@extends('teacher.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h1>Edit</h1>
            <div class="divider"></div>
        </div>
    </div>
    @include('teacher.layouts.errors')
    <div class="row">
        <form id="teacher-form" class="col s12" action="{{route('teacher-update')}}" onsubmit="return validateForm('#teacher-form')" method="post">
            {{csrf_field()}}
            <div class="row">
                <h4>Teacher</h4>
                <div class="input-field col s12">
                    <input value="@if(old('name')){{old('name')}}@else{{\Auth::user()->name}} @endif"
                           placeholder="Placeholder" id="first_name" type="text" class="validate" name="name">
                    <label for="first_name">{{trans('form.label.name')}}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input value="@if(old('email')){{old('email')}}@else{{\Auth::user()->email}} @endif" id="email"
                           type="email" class="validate" name="email">
                    <label for="email">{{trans('form.label.email')}}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate ignore" name="password">
                    <label for="password">{{trans('form.label.password')}}</label>
                </div>
            </div>
            <div class="input-field">
                <button type="submit" class="btn  waves-effect">{{trans('form.button.save')}}</button>
            </div>
        </form>
    </div>
    @include('teacher.studio.edit')
@endsection