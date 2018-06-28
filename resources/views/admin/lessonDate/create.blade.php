
<div class="modal-content">
    <h4>Voeg een evenement toe</h4>
    <hr>
</div>


<div class="container">
    <ul class="tabs" id="eventTabs">
        @foreach($teachers as $teacher)
            <li class="tab eventTab col s3" id="t{{$teacher->id}}"><a href="#teacher{{$teacher->id}}" style="color: {{$teacher->color}};">{{$teacher->name}}</a></li>
        @endforeach
    </ul>
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
        <button type="button" class="btn waves-effect show-swal-loading" data-message="Tijden aan het toevoegen/verwijderen" id="lesson_date_save">Opslaan</button>
    </div>
</div>

<div style="display:block;" id="data_2" data-teachers="{{json_encode($teachers)}}"></div>


<script>
    var data = document.getElementById('data_2');

    var teachers = JSON.parse(data.dataset.teachers);
</script>
