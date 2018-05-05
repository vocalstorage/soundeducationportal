@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Lessons</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            @if(count($lessons) > 0)
            <ul class="collapsibleSchedule collapsible popout">
                @foreach($lessons as $lesson)
                    <li>
                        <div class="collapsible-header">
                            <div class="card w-100">
                                <div class="card-image">
                                    <img src="http://via.placeholder.com/1080x500">
                                    <span class="card-title">{{$lesson->title}}</span>
                                </div>
                                <div class="card-content">
                                    {{$lesson->description}}
                                </div>
                                <div class="card-action">
                                   @if(!in_array($lesson->id,$registeredLessons)) <a class="btn waves-effect green lighten-1"><i
                                                class="material-icons right">create</i>schedule</a>
                                    @else
                                        Already scheduled
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="collapsible-body">
                            <div class="row">
                                <div class="col s12">
                                    <h3 style="margin: 0px" id="lesson_locations_{{$lesson->id}}">Locations</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="teacher_lesson_wrapper">
                                @foreach($lesson->lessonDates->unique('teacher_id') as $lesson_date)
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="http://via.placeholder.com/720x300">
                                                    <span class="card-title">{{$lesson_date->teacher->studio->name}}
                                                        ({{$lesson_date->teacher->name." ".$lesson_date->teacher->prefix." ".$lesson_date->teacher->lastname}})
                                                    </span>
                                                </div>
                                                <div class="card-content">
                                                    <p>{{$lesson_date->teacher->studio->description}}</p>
                                                    <hr>

                                                        <ul>
                                                            <li>Street: {{$lesson_date->teacher->studio->street}}</li>
                                                            <li>City: {{$lesson_date->teacher->studio->place}}</li>
                                                            <li>Postal
                                                                code:{{$lesson_date->teacher->studio->postal_code}}</li>
                                                        </ul>

                                                </div>
                                                <div class="card-action">
                                                    @if(!in_array($lesson->id,$registeredLessons))
                                                        <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}" class="btn waves-effect green lighten-1 schedule-lessonDate"><i
                                                                    class="material-icons right">create</i>Schedule</a>

                                                    @else
                                                        Already scheduled
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="center-align btnScheduleLessonsBack">
                                <i class="large material-icons">expand_less</i>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
                <div>
                    <h5 class="center-align">No lessons found</h5>
                </div>
            @endif
        </div>
    </div>

@endsection