@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1>{{trans('modules/teacher.function.create')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-teacher-store')}}" method="post">
                {{csrf_field()}}
                <div class="input-field">
                    <input id="name" type="text" class="validate{{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{old('name') ? old('name') : ''}}">
                    <label for="name">{{trans('form.label.name')}}</label>
                    @if ($errors->has('name'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>

                <div class="input-field">
                    <input id="email" type="email"  class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{old('email') ? old('email') : ''}}">
                    <label for="email">{{trans('form.label.email')}}</label>
                    @if ($errors->has('email'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <input name='color' id="color" type="text" class="colorpicker validate {{ $errors->has('color') ? ' invalid' : '' }}" value="{{old('color') ? old('color') : ''}}" />
                    <label for="color">{{trans('form.label.color')}}</label>
                @if ($errors->has('color'))
                        <span class="helper-text" data-error="{{ $errors->first('color') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <button type="submit" class="btn  waves-effect show-swal-loading" data-message="Leraar aan het creëer">{{trans('form.button.save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection