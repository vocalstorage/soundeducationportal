@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Planner</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                <div id="calendar_lessondate"></div>
                    </div>
                </div>
            </div>
        </div>
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

    <script>
        var events = {!! json_encode($events) !!};
    </script>
@endsection