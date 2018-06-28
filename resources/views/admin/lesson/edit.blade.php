@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">{{trans('modules/lesson.function.edit')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-lesson-update', $lesson->id)}}"  method="post">
                {{csrf_field()}}
                <form>
                    <div class="input-field col s12">
                        <input value="{{old('title') ? old('title') : $lesson->title}}" type="text" class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title" id="title">
                        <label class="active" for="title">{{trans('form.label.title')}}</label>
                        @if ($errors->has('title'))
                            <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s12">
                        <textarea name="description" id="editor"
                                class="validate {{ $errors->has('description') ? ' invalid' : '' }}">
                        {{old('description') ? old('description') : $lesson->description}}
                        </textarea>
                        @if ($errors->has('description'))
                            <span class="helper-text red-text">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="input-field col s12">
                        <input value="{{old('max_registration') ? old('max_registration') : $lesson->max_registration}}" type="number" min="1" name="max_registration"
                               class="validate {{ $errors->has('max_registration') ? ' invalid' : '' }}" id="max">
                        <label class="active" for="max">{{trans('form.label.max_registrations')}}</label>
                        @if ($errors->has('max_registration'))
                            <span class="helper-text" data-error="{{ $errors->first('max_registration') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s12">
                        <input id="deadline" value="{{old('deadline') ? old('deadline') : $lesson->deadline->format('d/m/Y')}}" type="text"
                               class="validate {{ $errors->has('deadline') ? ' invalid' : '' }}" name="deadline">
                        <label for="deadline">{{trans('form.label.deadline')}}</label>
                        @if ($errors->has('deadline'))
                            <span class="helper-text" data-error="{{ $errors->first('deadline') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s12">
                        <select multiple name="teachers[]" class="validate {{ $errors->has('teachers') ? ' invalid' : '' }}">
                            <option value="" disabled selected>{{trans('form.select.select_option')}}</option>
                            @foreach($teachers as $teacher)
                                @if($teacher->studio)
                                    <option @if($lesson->teachers->contains($teacher)) selected @endif value="{{$teacher->id}}"  data-icon="{{$teacher->studio->filepath->path}}">{{$teacher->name}} ({{$teacher->studio->name}})</option>
                                @endif
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
                            <input id="thumbnail" class="validate {{ $errors->has('filepath') ? ' invalid' : '' }}" type="text" name="filepath"  value="{{old('filepath') ? old('filepath') : $lesson->filepath->path}}">
                            <label for="thumbnail">{{trans('form.label.image')}}</label>
                        @if ($errors->has('filepath'))
                                <span class="helper-text" data-error="{{ $errors->first('filepath') }}"></span>
                            @endif
                        </div>
                    </div>
                    <div class="col s2">
                        <img src="{{$lesson->filepath->path}}" id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    <div class="input-field col s12">
                        <select name="schoolgroup_id" class="validate {{ $errors->has('schoolgroup_id') ? ' invalid' : '' }}">
                            <option value="" disabled>{{trans('form.select.select_option')}}</option>
                            @foreach($schoolgroups as $schoolgroup)
                                <option @if($lesson->schoolgroup->id == $schoolgroup->id) selected @endif value="{{$schoolgroup->id}}">{{$schoolgroup->title}}</option>
                            @endforeach
                        </select>
                        <label>{{trans('form.label.class')}}</label>
                        @if ($errors->has('schoolgroup_id'))
                            <span class="helper-text" data-error="{{ $errors->first('schoolgroup_id') }}"></span>
                        @endif
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn  waves-effect show-swal-loading" data-message="Editing lesson">{{trans('form.button.save')}}</button>
                    </div>
                </form>
        </div>
    </div>
@endsection