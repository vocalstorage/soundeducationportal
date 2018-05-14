@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Edit lesson</h1></div>
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
                        <input value="{{$lesson->deadline}}" type="number" min="1" name="deadline"
                               class="validate" id="deadline">
                        <label class="active" for="deadline">deadline:</label>
                    </div>
                    <div class="input-field">
                        <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                    </div>
                </form>
        </div>
    </div>
@endsection