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

    <div class="switch col s2" style="display: none">
        <label>
            Afwezig
            <input type="checkbox">
            <span class="lever"></span>
            Aanwezig
        </label>
    </div>
@endsection

<script>
    var events = {!! json_encode($events) !!};

    var current_lesson_id = {!! $lesson_id !!};

    var deadline = {!! json_encode($deadline) !!};
</script>