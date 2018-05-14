@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Scheduler</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div id="calendar_lessondate"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="eventModal" class="modal eventModal">

    </div>
@endsection

<script>
    var events = {!! json_encode($events) !!};

    var current_lesson_id = {!! $lesson_id !!};

</script>