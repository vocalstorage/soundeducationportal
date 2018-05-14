
<div class="modal-content">
    <h4>Voeg een evenement toe</h4>
    <hr>
</div>


<div class="container">
    <div class="col s12">
        <ul class="tabs" id="eventTabs">

            @foreach($teachers as $teacher)
            <li class="tab eventTab col s3" id="t{{$teacher->id}}"><a href="#teacher{{$teacher->id}}" style="color: {{$teacher->color}};">{{$teacher->name}}</a></li>
            @endforeach
        </ul>
    </div>
    @foreach($teachers as $teacher)
    <div id="teacher{{$teacher->id}}" class="col s12">
        <table class="table">
            <thead>
            <tr>
            {!! $teacher->timesHtml !!}
            </tr>
            </thead>
        </table>
    </div>
    @endforeach

    <div class="input-field" id="times">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn waves-effect waves-light green lighten-1" id="lesson_date_save">Opslaan</button>
    </div>
</div>

<script>
    var teachers = {!! json_encode($teachers) !!}
    console.log(teachers);
</script>