@extends('teacher.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1>Planner - {{$lesson->title}}</h1></div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div id="calendar_lessondate" class="animate fadeIn" style="{{$calendarView === 'lessonDate' ? '' : 'display:none'}}" ></div>
                    <div id="calendar_presence" class="animate fadeIn" style="{{$calendarView === 'presence' ? '' : 'display:none'}}" ></div>
                </div>
            </div>
        </div>
    </div>

    <div class="switch" style="display: none">
        <label>
            Afwezig
            <input type="checkbox" class="presence" data-id="0">
            <span class="lever"></span>
            Aanwezig
        </label>
    </div>


    <!-- Modal Structure -->
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

    <div id="commentModal" class="modal commentModal">
        <div class="modal-content">
            <h1>Bericht</h1>
            <div class="divider"></div>
            <p class="modal-phrase">A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect green-text lighten-1 btn-flat">Oke</a>
        </div>
    </div>
@endsection

<div style="display:block;" id="data" data-events="{{json_encode($events)}}" data-event_regs="{{json_encode($event_regs)}}" data-currentLessonId="{{$lesson->id}}" data-deadline="{{$lesson->deadline}}"></div>

<script>
    var data = document.getElementById('data');
    var events = JSON.parse(data.dataset.events);
    var event_regs = JSON.parse(data.dataset.event_regs);
    var current_lesson_id = data.dataset.currentlessonid;
    var deadline = data.dataset.deadline;
</script>