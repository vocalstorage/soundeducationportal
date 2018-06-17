@extends('teacher.layouts.master')

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
                    <div id="calendar_lessondate" class="animate fadeIn"></div>
                    <div id="calendar_presence" class="animate fadeIn" style="display: none" ></div>
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

<script>
    var events = {!! json_encode($events) !!};

    var event_regs = {!! json_encode($event_regs) !!};

    var current_lesson_id = {!! $lesson_id !!};

    var deadline = {!! json_encode($deadline) !!};

</script>