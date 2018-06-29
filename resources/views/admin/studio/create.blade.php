@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">{{trans('modules/studio.function.create')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-studio-store')}}" method="post">
                {{csrf_field()}}

                <div class="input-field">
                    <input id="name" type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}"
                           value="{{old('name') ? old('name') : ''}}" name="name">
                    <label for="name">{{trans('form.label.title')}}</label>
                    @if ($errors->has('name'))
                        <span class="helper-text" data-error="{{ $errors->first('name') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <textarea name="description" id="editor"
                                class="validate {{ $errors->has('description') ? ' invalid' : '' }}">
                        {{old('description') ? old('description') : ''}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="helper-text red-text">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="input-field col s5">
                        <input id="place" type="text" class="validate {{ $errors->has('place') ? ' invalid' : '' }}"
                               value="{{old('place') ? old('place') : ''}}" name="place">
                        <label for="place">{{trans('form.label.place')}}</label>
                        @if ($errors->has('place'))
                            <span class="helper-text" data-error="{{ $errors->first('place') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s5">
                        <input id="street" type="text" class="validate {{ $errors->has('street') ? ' invalid' : '' }}"
                               value="{{old('street') ? old('street') : ''}}" name="street">
                        <label id="street">{{trans('form.label.street')}}</label>
                        @if ($errors->has('street'))
                            <span class="helper-text" data-error="{{ $errors->first('street') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s2">
                        <input id="number" type="text" class="validate {{ $errors->has('number') ? ' invalid' : '' }}"
                               value="{{old('number') ? old('number') : ''}}" name="number">
                        <label for="number">{{trans('form.label.number')}}</label>
                        @if ($errors->has('number'))
                            <span class="helper-text" data-error="{{ $errors->first('number') }}"></span>
                        @endif
                    </div>
                </div>

                <div class="input-field">
                    <input id="postal_code" type="text"
                           class="validate {{ $errors->has('postal_code') ? ' invalid' : '' }}"
                           value="{{old('postal_code') ? old('postal_code') : ''}}" name="postal_code">
                    <label for="postal_code">{{trans('form.label.zipcode')}}</label>
                    @if ($errors->has('postal_code'))
                        <span class="helper-text" data-error="{{ $errors->first('postal_code') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <select id="teacher_id" class="validate {{ $errors->has('teacher_id') ? ' invalid' : '' }}"
                            name="teacher_id">
                        <option value="" disabled selected>{{trans('form.label.studios')}}</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                    <label for="teacher_id">{{trans('form.label.owner')}}</label>
                    @if ($errors->has('teacher_id'))
                        <span class="helper-text" data-error="{{ $errors->first('teacher_id') }}"></span>
                    @endif
                </div>
                <label>{{trans('form.label.image')}}</label>
                <div class="file-field input-field col s10">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <div class="btn  waves-effect">
                            <i class="material-icons white-text">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="validate {{ $errors->has('filepath') ? ' invalid' : '' }}" type="text" name="filepath" value="{{old('filepath') ? old('filepath') : ''}}">
                        @if ($errors->has('filepath'))
                            <span class="helper-text" data-error="{{ $errors->first('filepath') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="col s2">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn  waves-effect show-swal-loading" data-message="Studio aan het creëer">
                        {{trans('form.button.save')}}
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection