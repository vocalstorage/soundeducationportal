@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create Teacher</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="/admin/teacher/store" onsubmit="return validateForm('Creating teacher')" method="post">
                {{csrf_field()}}
                <div class="input-field">
                    <input id="name" type="text" class="validate{{ $errors->has('name') ? ' invalid' : '' }}" placeholder="Enter name" name="name" value="{{old('name') ? old('name') : ''}}">
                    <label for="name">Name:</label>
                    @if ($errors->has('name'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>

                <div class="input-field">
                    <input id="email" type="email"  class="validate {{ $errors->has('email') ? ' invalid' : '' }}" placeholder="Enter email" name="email" value="{{old('email') ? old('email') : ''}}">
                    <label for="email">email:</label>
                    @if ($errors->has('email'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <input name='color' id="color" type="text" class="colorpicker validate {{ $errors->has('color') ? ' invalid' : '' }}" value="{{old('color') ? old('color') : ''}}" required/>
                    {{--<input type="text" id="color" class="validate {{ $errors->has('color') ? ' invalid' : '' }}"  style="display: none"/>--}}
                    @if ($errors->has('color'))
                        <span class="helper-text" data-error="{{ $errors->first('color') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection