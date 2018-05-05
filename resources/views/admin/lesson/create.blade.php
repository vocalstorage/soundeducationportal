@extends('admin.layouts.master')

@section('content')
    <div id="createLessonContainer" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <form id="lesson_form"  action="{{route('admin-lesson-store')}}" onsubmit="return validateForm()" method="post">
        <div class="row">
            <div class="col-lg-4" id="lesson_header">
               <h1 class="h2">Create lesson</h1>
            </div>
            <div class="col-lg-8" id="lesson_header_function">
            </div>
        </div>
        <hr>
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-5" id="scheduler-form-right">

                <div class="input-field">
                    <label for="usr">Les naam:</label>
                    <input type="text" id="lessonTitle" placeholder="titel" name="title" class="validate">
                </div>
                <div id="description"></div>
                <div class="input-field">
                    <label for="sel1">Max studenten:</label>
                    <input type="number" min="1" placeholder="number" name="max_registration" class="validate">
                </div>
                <div class="form-group" id="deadlineForm">
                    <label>Deadline</label>
                    <input type="number" class="form-control" id="deadlineNr" min="1" max="20" class="validate" name="deadline">
                </div>
            </div>
            <div class="col-md-6" id="scheduler-form-left">
                @include('admin.layouts.lessonDateForm')
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div id="showLessonDates">
                        <table style="margin-top: 2%" id="dates-table-items">
                            <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody class="tbodyDate">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="all_lesson_dates">

            </div>
        </form>
        <div class="chips-initial"></div>
@endsection