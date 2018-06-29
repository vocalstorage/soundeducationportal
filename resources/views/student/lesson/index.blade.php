@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h1 style="margin: 0px">Lessen</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            @if(count($lessons) > 0)
                <ul class="collapsibleSchedule collapsible popout">
                    @foreach($lessons as $lesson)
                        <li class="studio-item">
                            <div class="collapsible-header">
                                <div class="card w-100">
                                    <div class="card-image card-image-lesson-index">
                                        <img src="{{$lesson->filepath->path}}" height="500" style="width: 100%">
                                    </div>

                                    <div class="card-content">
                                        <h1 class="margin-none">{{$lesson->title}}</h1>
                                        @if($lesson->maySchedule())
                                            <h5>{{$lesson->diffDeadline() ? 'nog '. $lesson->diffDeadline(). ' dag(en) voor de deadline' : 'deadline behaald'}}</h5>
                                        @endif
                                        <div class="card-description">
                                            <p>{!! $lesson->description!!}</p>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        @if(in_array($lesson->id,$registeredLessons))
                                            <h5>Al ingeschreven.</h5>
                                        @elseif(!$lesson->maySchedule())
                                            <p>Inschrijven niet meer mogelijk, deadline is behaald.</p>
                                        @else
                                            <a class="btn waves-effect "><i class="material-icons right"
                                                                            style="color:white">create</i>Plannen</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="col s12">
                                        <h3 style="margin: 0px" id="lesson_locations_{{$lesson->id}}">Selecteer een
                                            locatie</h3>
                                        <hr>
                                    </div>
                                </div>
                                <div class="teacher_lesson_wrapper">
                                    <div class="row">
                                        <div class="col s12 show-on-medium-and-down hide-on-med-and-up">
                                            <ul class="tabs">
                                                @foreach($lesson->lessonDates->unique('teacher_id') as $lesson_date)
                                                    @if($lesson_date->teacher->studio()->exists())
                                                        <li class="tab col s3"><a href="#teacher{{$lesson_date->teacher->id}}" class="{{$loop->first ? 'active' : ''}}">{{$lesson_date->teacher->studio->place}} - {{$lesson_date->teacher->name}} ({{$lesson_date->teacher->studio->name}})</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @foreach($lesson->lessonDates->unique('teacher_id') as $lesson_date)
                                                @if($lesson_date->teacher->studio()->exists())
                                                    <div class="col s12" id="teacher{{$lesson_date->teacher->id}}">
                                                        <div class="card card-studio">
                                                            <div class="card-image">
                                                                <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}">
                                                                    <img src="{{$lesson_date->teacher->studio->filepath->path}}" height="200" style="width: 100%">
                                                                </a>
                                                            </div>
                                                            <div class="card-content card-studio-content">
                                                                <h5>{{$lesson_date->teacher->studio->place}} -
                                                                    {{$lesson_date->teacher->studio->name}}
                                                                    ({{$lesson_date->teacher->name." ".$lesson_date->teacher->prefix." ".$lesson_date->teacher->lastname}})
                                                                </h5>
                                                                <div class="divider"></div>
                                                                <div class="card-description">
                                                                    <p>{!!  $lesson_date->teacher->studio->description!!}</p>
                                                                </div>
                                                                <div class="divider"></div>
                                                                <div class="wrapper-location-data">
                                                                    <h5>Gegevens</h5>
                                                                    <p>
                                                                        Straat: {{$lesson_date->teacher->studio->street}}</p>
                                                                    <p>
                                                                        Plaats: {{$lesson_date->teacher->studio->place}}</p>
                                                                    <p>
                                                                        Postcode: {{$lesson_date->teacher->studio->postal_code}}</p>
                                                                </div>

                                                            </div>
                                                            <div class="card-action">
                                                                @if(!$lesson->maySchedule())
                                                                    <p> Inschrijven niet meer mogelijk, deadline is
                                                                        behaald.</p>
                                                                @elseif(!in_array($lesson->id,$registeredLessons) )
                                                                    <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}"
                                                                       class="btn waves-effect  schedule-lessonDate w-100">plannen</a>
                                                                @else
                                                                    <p>Al ingeschreven</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        @foreach($lesson->lessonDates->unique('teacher_id') as $lesson_date)
                                            @if($lesson_date->teacher->studio()->exists())
                                                <div class="col xl4 l6 hide-on-med-and-down">
                                                    <div class="card card-studio">
                                                        <div class="card-image">
                                                            <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}">
                                                                <img src="{{$lesson_date->teacher->studio->filepath->path}}" height="200" style="width: 100%">
                                                            </a>
                                                        </div>                                                        <div class="card-content card-studio-content">
                                                            <h5 class="card-studio-title">{{$lesson_date->teacher->studio->place}} -
                                                                {{$lesson_date->teacher->studio->name}}
                                                                ({{$lesson_date->teacher->name." ".$lesson_date->teacher->prefix." ".$lesson_date->teacher->lastname}}
                                                                )
                                                            </h5>
                                                            <div class="divider"></div>
                                                            <div class="card-description card-studio-description">
                                                                <p>{!!  $lesson_date->teacher->studio->description!!}</p>
                                                            </div>
                                                            <div class="divider"></div>
                                                            <div class="wrapper-location-data">
                                                                <h5>Gegevens</h5>
                                                                <p>
                                                                    Straat: {{$lesson_date->teacher->studio->street}}</p>
                                                                <p>
                                                                    Plaats: {{$lesson_date->teacher->studio->place}}</p>
                                                                <p>
                                                                    Postcode: {{$lesson_date->teacher->studio->postal_code}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-action">
                                                            @if(!$lesson->maySchedule())
                                                                <p> Inschrijven niet meer mogelijk, deadline is
                                                                    behaald.</p>
                                                            @elseif(!in_array($lesson->id,$registeredLessons) )
                                                                <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}"
                                                                   class="btn waves-effect  schedule-lessonDate w-100">plannen</a>
                                                            @else
                                                                <p>Al ingeschreven</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="center-align btnScheduleLessonsBack">
                                    <i class="large material-icons">expand_less</i>
                                </div>
                            </div>
                    @endforeach
                </ul>
            @else
                <div>
                    <h5 class="center-align animated fadeIn">Geen lessen gevonden</h5>
                </div>
            @endif
        </div>
    </div>
@endsection