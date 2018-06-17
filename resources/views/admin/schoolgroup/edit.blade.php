@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Voeg klass toe</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-schoolgroup-update', $schoolgroup->id)}}" onsubmit="return validateForm('Editing class')" method="post">
                {{csrf_field()}}
                <div class="input-field col s12">
                    <input id="schoolgroup" value="@if(old('title')){{old('title')}}@else {{$schoolgroup->title}}@endif" type="text"
                           class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title">
                    <label for="title">Klas naam</label>
                    @if ($errors->has('class'))
                        <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button id="createSchoolgroup" type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection