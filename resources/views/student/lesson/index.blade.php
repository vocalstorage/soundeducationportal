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
                                            <h2 class="margin-none">{{$lesson->title}}</h2>

                                           <h5>{{$lesson->diffDeadline() ? 'nog '. $lesson->diffDeadline(). ' dag(en) voor de deadline' : 'deadline behaald'}}</h5>

                                            {!! $lesson->description!!}
                                        </div>
                                        <div class="card-action">
                                            @if(in_array($lesson->id,$registeredLessons))
                                                Al ingeschreven.
                                            @elseif($lesson->diffDeadline() < 5)
                                                Inschrijven niet meer mogelijk, deadline is behaald.
                                            @else
                                            <a class="btn waves-effect green lighten-1"><i class="material-icons right" style="color:white">create</i>Plannen</a>
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
                                            @foreach($lesson->lessonDates->unique('teacher_id') as $lesson_date)
                                                @if($lesson_date->teacher->studio()->exists())
                                                    <div class="col s12 l4 ">
                                                        <div class="card card-studio">
                                                            <img src="{{$lesson_date->teacher->studio->filepath->path}}"
                                                                 height="200" style="width: 100%">
                                                            <div class="card-content card-studio-content">
                                                                <div class="row">
                                                                    <div class="col s12">
                                                                        <h4> {{$lesson_date->teacher->studio->name}}
                                                                            ({{$lesson_date->teacher->name." ".$lesson_date->teacher->prefix." ".$lesson_date->teacher->lastname}})
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col s12">
                                                                        <p>{!!  $lesson_date->teacher->studio->description!!}</p>
                                                                    </div>
                                                                    <div class="col s12">
                                                                        <div class="wrapper-location-data">
                                                                            <h4>Gegevens</h4>
                                                                            <p>Straat: {{$lesson_date->teacher->studio->street}}</p>
                                                                            <p>Plaats: {{$lesson_date->teacher->studio->place}}</p>
                                                                            <p>Postcode: {{$lesson_date->teacher->studio->postal_code}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-action">
                                                                @if($lesson->diffDeadline() < 5)
                                                                    Inschrijven niet meer mogelijk, deadline is behaald.
                                                                @elseif(!in_array($lesson->id,$registeredLessons) )
                                                                    <a href="{{route('student-lessonDate-show',array($lesson_date->teacher->id, $lesson->id))}}" class="btn waves-effect green lighten-1 schedule-lessonDate w-100">plannen</a>
                                                                @else
                                                                    Al ingeschreven
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