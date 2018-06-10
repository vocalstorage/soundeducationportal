@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Edit Lesson</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-lesson-update', $lesson->id)}}" onsubmit="return validateForm()" method="post">
                {{csrf_field()}}
                <form>
                    <div class="input-field">
                        <input value="{{$lesson->title}}" type="text" class="validate" name="title" id="title">
                        <label class="active" for="title">Lesson name:</label>
                    </div>
                    <label class="active" for="description_value">description:</label>
                    <div id="description"></div>
                    <input value="{{$lesson->description}}" id="description_value" type="hidden">

                    <div class="input-field">
                        <input value="{{$lesson->max_registration}}" type="number" min="1" name="max_registration"
                               class="validate" id="max">
                        <label class="active" for="max">max:</label>
                    </div>
                    <div class="input-field">
                        <label>Deadline</label>
                        <input type="text" class="deadline"  name="deadline" value="{{$lesson->deadline}}">
                    </div>
                    <div class="input-field col s12">
                        <select multiple name="teachers">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach($teachers as $teacher)
                                @if($teacher->studio)
                                    <option @if($lesson->teachers->contains($teacher)) selected @endif value="{{$teacher->id}}"  data-icon="{{$teacher->studio->filepath->path}}">{{$teacher->name}} ({{$teacher->studio->name}})</option>
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
                            <input id="thumbnail" class="form-control" type="text" name="filepath"  value="{{$lesson->filepath->path}}">
                        </div>
                    </div>
                    <div class="col s2">
                        <img src="{{$lesson->filepath->path}}" id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    <div class="input-field">
                        <button type="submit" class="btn green lighten-1 waves-effect">Save</button>
                    </div>
                </form>
        </div>
    </div>
@endsection