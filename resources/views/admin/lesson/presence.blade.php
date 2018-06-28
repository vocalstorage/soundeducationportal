@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h2 class="h2">Aanwezigheid</h2></div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div id="calendar_presence"></div>
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
<div style="display:block;" id="data" data-events="{{json_encode($events)}}" data-currentLessonId="{{$lesson->id}}" data-deadline="{{$lesson->deadline}}"></div>

<script>
    var data = document.getElementById('data');
    var events = JSON.parse(data.dataset.events);

    var current_lesson_id = data.dataset.currentlessonid;
    var deadline = data.dataset.deadline;
</script>