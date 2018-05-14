@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Lessons</h1> <a href="create">Create a new lesson</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div id="accordion">
                <table class="table table-striped " style="margin-top: 2%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Lesson Title</th>
                        <th>Max</th>
                        <th>Deadline</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr>
                            <td>{{$lesson->title}}</td>
                            <td>{{$lesson->deadline}}</td>
                            <td>{{$lesson->max_registration}}</td>
                            <td>
                                <a href="{{route('admin-lesson-show',$lesson->id)}}" class="lesson_show">
                                    <i class="material-icons">remove_red_eye</i>
                                </a>
                                <a href="{{route('admin-lesson-edit',$lesson->id)}}" class="lesson_edit">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="confirm_delete">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$lessons->links() }}
            </div>
        </div>
    </div>
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