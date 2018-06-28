@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col s8">
            <div style="float:left;"><h1>{{trans('modules/lesson.function.create')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form id="lesson_form" action="{{route('admin-lesson-store')}}"  method="post">
                {{csrf_field()}}
                <div class="input-field col s12">
                    <input id="title" value="{{old('title') ? old('title') : ''}}" type="text" class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title">
                    <label for="title">{{trans('form.label.title')}}</label>
                    @if ($errors->has('title'))
                        <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <textarea name="description" id="editor" class="validate {{ $errors->has('description') ? ' invalid' : '' }}">
                        {{old('description') ? old('description') : ''}}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="helper-text red-text">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <input id="max_registration" value="{{old('max_registration') ? old('max_registration') : ''}}" type="number" class="validate {{ $errors->has('max_registration') ? ' invalid' : '' }}" name="max_registration" >
                    <label for="max_registration">{{trans('form.label.max_registrations')}}</label>
                    @if ($errors->has('max_registration'))
                        <span class="helper-text" data-error="{{ $errors->first('max_registration') }}"></span>
                    @endif
                </div>

                <div class="input-field col s12">
                    <input id="deadline" value="{{old('deadline') ? old('deadline') : ''}}" type="text"
                           class="validate {{ $errors->has('deadline') ? ' invalid' : '' }}" name="deadline">
                    <label for="deadline">{{trans('form.label.deadline')}}</label>
                    @if ($errors->has('deadline'))
                        <span class="helper-text" data-error="{{ $errors->first('deadline') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <select id="teachers" multiple name="teachers[]" class="validate {{ $errors->has('teachers') ? ' invalid' : '' }}">
                        <option value="" disabled selected>{{trans('form.select.select_option')}}</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}"  data-icon="{{$teacher->studio->filepath->path}}">{{$teacher->name}} ({{$teacher->studio->name}})</option>
                        @endforeach
                    </select>
                    <label>{{trans('form.label.teachers')}}</label>
                    @if ($errors->has('teachers'))
                        <span class="helper-text" data-error="{{ $errors->first('teachers') }}"></span>
                    @endif
                </div>

                <div class="file-field input-field col s10">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <div class="btn  waves-effect">
                            <i class="material-icons white-text">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="validate {{ $errors->has('filepath') ? ' invalid' : '' }}" type="text"
                               name="filepath" value="{{old('filepath') ? old('filepath') : ''}}">
                        <label for="thumbnail">{{trans('form.label.image')}}</label>
                    @if ($errors->has('filepath'))
                            <span class="helper-text" data-error="{{ $errors->first('filepath') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="col s2">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="input-field col s12">
                    <select id="schoolgroup" name="schoolgroup_id" class="validate {{ $errors->has('schoolgroup_id') ? ' invalid' : '' }}">
                        <option value="" disabled selected>{{trans('form.select.select_option')}}</option>
                        @foreach($schoolgroups as $schoolgroup)
                            <option value="{{$schoolgroup->id}}">{{$schoolgroup->title}}</option>
                        @endforeach
                    </select>
                    <label>{{trans('form.label.class')}}</label>
                    @if ($errors->has('schoolgroup_id'))
                        <span class="helper-text" data-error="{{ $errors->first('schoolgroup_id') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button type="submit" id="btn_save" class="btn waves-effect show-swal-loading" data-message="Creeren van klas">{{trans('form.button.save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection