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
            <div id="calendar_lessondate"></div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="eventModal" class="modal">

    </div>
    <!-- Modal Structure -->
    <div id="addEventModal" class="modal">

    </div>


    <script>
        var events = {!! json_encode($events) !!};
    </script>
@endsection