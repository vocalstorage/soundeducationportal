@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h2 class="h2">Scheduler</h2></div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div id="calendar_lessondate"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="mycalendar"></div>

    <div class="switch" style="display: none">

        <label>
            Afwezig
            <input type="checkbox" class="presence" data-id="0">
            <span class="lever"></span>
            Aanwezig
        </label>

    </div>


    <div id="eventModal" class="modal eventModal">
        <div class="event-modal-content">

        </div>
        <div class="preloader-wrapper big active" id="eventModalLoader">
            <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="legend">
        <ul class="collection">
            <li class="collection-item  white-text">Teachers</li>
            @foreach($lesson->teachers as $teacher)
                    <li class="collection-item">
                        <label>
                            <input class="legend-lesson-filter" data-color="{{$teacher->color}}")  style="color: {{$teacher->color}}" type="checkbox" checked />
                            <span style="color: {{$teacher->color}}">{{$teacher->name}} </span>
                        </label>
                        <div class="color-box right" style="background-color: {{$teacher->color}}"></div>
                    </li>
            @endforeach
        </ul>
    </div>
@endsection

<div style="display:block;" id="data" data-events="{{json_encode($events)}}" data-currentLessonId="{{$lesson->id}}" data-deadline="{{$lesson->deadline}}" data-currentColors="{{json_encode($lesson->teachers()->pluck('color')->toArray())}}"></div>

<script>
    var data = document.getElementById('data');
    var events = JSON.parse(data.dataset.events);
    var current_lesson_id = data.dataset.currentlessonid;
    var deadline = data.dataset.deadline;
    var current_colors = JSON.parse(data.dataset.currentcolors);
</script>