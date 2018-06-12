@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1>Create Lesson</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form id="lesson_form" action="{{route('admin-lesson-store')}}" onsubmit="return validateForm()"
                  method="post">
                {{csrf_field()}}

                <div class="input-field col s12">
                    <input id="title" value="@if(old('title')){{old('title')}}@endif" type="text"
                           class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title">
                    <label for="title">Title</label>
                    @if ($errors->has('title'))
                        <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                    @endif
                </div>

                <div class="col s12">
                    <label class="active" for="description_value">Description:</label>
                    <div id="description"></div>
                    <input id="description_value" class="validate" type="hidden" name="description"
                           value="@if(old('description')){{old('description')}}@endif" required>
                </div>

                <div class="input-field col s12">
                    <input id="max_registration" value="@if(old('max_registration')){{old('max_registration')}}@endif"
                           type="number"
                           class="validate {{ $errors->has('max_registration') ? ' invalid' : '' }}"
                           name="max_registration">
                    <label for="max_registration">Max registrations</label>
                    @if ($errors->has('max_registration'))
                        <span class="helper-text" data-error="{{ $errors->first('max_registration') }}"></span>
                    @endif
                </div>

                <div class="input-field col s12">
                    <input id="deadline" value="@if(old('deadline')){{old('deadline')}}@endif" type="text"
                           class="validate {{ $errors->has('deadline') ? ' invalid' : '' }}" name="deadline">
                    <label for="deadline">Deadline</label>
                    @if ($errors->has('deadline'))
                        <span class="helper-text" data-error="{{ $errors->first('deadline') }}"></span>
                    @endif
                </div>

                <div class="input-field col s12">
                    <select multiple name="teachers">
                        <option value="" disabled selected>Choose your option</option>
                        @foreach($teachers as $teacher)
                            @if(count($teacher->studio))
                            <option value="{{$teacher->id}}"  data-icon="{{$teacher->studio->filepath->path}}">{{$teacher->name}} ({{$teacher->studio->name}})</option>
                            @endif
                        @endforeach

                    </select>
                    <label>Select teachers</label>
                </div>

                <label>Image:</label>
                <div class="file-field input-field col s10">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <div class="btn green lighten-1 waves-effect">
                            <i class="material-icons">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="form-control validate {{ $errors->first('filepath') }}" type="text"
                               name="filepath" value="@if(old('filepath')){{old('filepath')}}@endif">
                    </div>
                    @if ($errors->has('filepath'))
                        <span class="helper-text" data-error="{{ $errors->first('filepath') }}"></span>
                    @endif
                </div>
                <div class="col s2">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="input-field col s12">
                    <select name="schoolgroup_id">
                        <option value="" disabled selected>Choose your option</option>
                        @foreach($schoolgroups as $schoolgroup)
                            <option value="{{$schoolgroup->id}}">{{$schoolgroup->title}}</option>
                        @endforeach
                    </select>
                    <label>Select an class</label>
                </div>
                <div class="input-field col s12">
                    <button type="submit" id="btn_save" class="btn green lighten-1 waves-effect">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection