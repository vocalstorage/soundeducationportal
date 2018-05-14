@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create lesson</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form id="lesson_form" action="{{route('admin-lesson-store')}}" onsubmit="return validateForm()"
                  method="post">
                {{csrf_field()}}
                <div class="input-field">
                    <label for="usr">Les naam:</label>
                    <input type="text" id="lessonTitle" placeholder="titel" name="title" class="validate {{ $errors->has('title') ? ' is-invalid' : '' }}">
                </div>
                <label class="active" for="description_value">description:</label>
                <div id="description"></div>
                <input id="description_value" type="hidden" name="description">
                <div class="input-field">
                    <label for="sel1">Max studenten:</label>
                    <input type="number" min="1" placeholder="number" name="max_registration" class="validate">
                </div>
                <div class="input-field">
                    <label>Deadline</label>
                    <input type="number" class="form-control" id="deadlineNr" min="1" max="20" class="validate" name="deadline">
                </div>
            </form>
        </div>
    </div>


@endsection