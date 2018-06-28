@extends('teacher.layouts.master')

@section('content')
    <div class="item">
        <div class="row">
            <div class="col s12">
                <div style="float:left;"><h1>{{trans('modules/lesson.title')}}</h1></div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div id="accordion">
                    <table class="table table-striped " style="margin-top: 2%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{trans('form.label.title')}}</th>
                            <th>{{trans('form.label.max_registrations')}}</th>
                            <th>{{trans('form.label.deadline')}}</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->max_registration}}</td>
                                <td>{{$lesson->deadline->format('d-m-Y')}}</td>
                                <td>
                                    <a href="{{route('teacher-lesson-show',[$lesson->id,'lessonDate'])}}" class="lesson_show">
                                        <i class="material-icons">event_note</i>
                                    </a>
                                    <a href="{{route('teacher-lesson-show',[$lesson->id,'presence'])}}" class="lesson_show">
                                        <i class="material-icons">access_time</i>
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
    </div>
@endsection