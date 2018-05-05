@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"><h1 class="h2">Lessons</h1> <a href="create">Create a new lesson</a></div>
            </div>
        </div>
        <div id="accordion">
            <table class="table table-striped " style="margin-top: 2%" cellspacing="0">
                <thead>
                <tr>
                    <th>Lesson Title</th>
                    <th>Description</th>
                    <th>Max</th>
                    <th>Deadline</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{$lesson->title}}</td>
                        <td>{!!$lesson->description!!}</td>
                        <td>{{$lesson->deadline}}</td>
                        <td>{{$lesson->max_registration}}</td>
                        <td><a href="#" class="btnShowLessonDates" data-toggle="collapse"
                               data-target="#showLessonDates{{$lesson->id}}" aria-expanded="false"
                               aria-controls="collapseExample" id="{{$lesson->id}}">
                                <i class="material-icons">expand_more</i>
                            </a>
                            <a href="{{route('admin-lesson_date-create',$lesson->id)}}" class="lesson_date_create">
                                <i class="material-icons">add_box</i>
                            </a>
                            <a href="{{route('admin-lesson-edit',$lesson->id)}}" class="lesson_edit">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="lesson_delete">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                    <tr style="display: none; line-height:0px;font-size:0px;height:0px;margin:0;padding:0" id="trShowLessonDates{{$lesson->id}}">
                        <td colspan="5">
                            <div class="collapse" id="showLessonDates{{$lesson->id}}" >
                                <table class="table table-striped " style="margin-top: 2%">
                                    <thead>
                                    <tr>
                                        <th>Teacher</th>
                                        <th>Date</th>
                                        <th>Deadline</th>
                                        <th>Time</th>
                                        <th>Registrations</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lesson->lessonDates as $date)
                                        <?php
                                        if ($lastDate == "empty" || $lastLessonId !== $lesson->id) {
                                            echo '<tr><td colspan="7" class="green lighten-1" style="color:white">' . date('Y-m-d', strtotime($date->date)) . '</td></tr>';

                                        } elseif ($date->date !== $lastDate) {
                                            echo '<tr><td colspan="7" class="green lighten-1" style="color:white">' . date('Y-m-d', strtotime($date->date)) . '</td></tr>';
                                        }
                                        $lastDate = $date->date;
                                        $lastLessonId = $lesson->id;
                                        ?>
                                        <tr>
                                            <td>{{$date->teacher->name}} {{$date->teacher->prefix}} {{$date->teacher->lastname}}</td>
                                            <td>{{date('Y-m-d',strtotime($date->date))}}</td>
                                            <td>{{$date->time}}</td>
                                            <td>{{$date->registrations}}</td>
                                            <td><a href="#" id="{{$date->id}}" class="lesson_date_edit">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a href="/admin/lesson_date/delete/{{$date->id}}">
                                                    <i class="material-icons">delete</i>
                                                </a>

                                                <a href="#" class="btnShowLessonDatesRegistrations" data-toggle="collapse" data-target="#showLessonDatesRegistrations{{$date->id}}" aria-expanded="false"  id="r{{$date->id}}">
                                                    <i class="material-icons">people</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr style="display: none; line-height:0px;font-size:0px;height:0px;margin:0;padding:0" id="trShowLessonDatesRegistrations{{$date->id}}">
                                            <td> <div class="collapse" id="showLessonDatesRegistrations{{$date->id}}">
                                                    <table class="table table-striped " style="margin-top: 2%">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>#</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($date->lessonDateRegistrations as $registration)
                                                            <td>{{$registration->student->name}}</td>
                                                            <td>{{$registration->student->email}}</td>
                                                            <td>#</td>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$lessons->links() }}
    </main>
    <div id="modal" class="modal times">
        <div class="modal-content">

        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat lesson_date_update">Edit</a>
        </div>
    </div>

    <div id="modal" class="modal lesson_edit_modal">
        <div class="lesson_edit_modal-content modal-content">

        </div>
        <hr>
        <div class="lesson_edit_modal-footer modal-footer">
            <a class="waves-effect waves-green btn lesson_update">Edit</a>
        </div>
    </div>

    <div id="modal" class="modal lesson_date_create_modal">
        <div class="lesson_date_create_modal-content modal-content">

        </div>
        <hr>
        <div class="lesson_date_create_modal-footer modal-footer">
            <a class=" waves-effect waves-green btn lesson_date_store">Store</a>
        </div>
    </div>
@endsection