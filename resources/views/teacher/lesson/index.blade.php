@extends('teacher.layouts.master')

@section('content')
    <div class="item">
        <div class="row">
            <div class="col s12">
                <div style="float:left;"><h1 class="h2 ">Lessons</h1></div>
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
                                <td>{{$lesson->max_registration}}</td>
                                <td>{{$lesson->deadline}}</td>
                                <td>
                                    <a href="{{route('teacher-lesson-show',$lesson->id)}}" class="lesson_show">
                                        <i class="material-icons">event_note</i>
                                    </a>
                                    <a href="{{route('teacher-lesson-presence',$lesson->id)}}">
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