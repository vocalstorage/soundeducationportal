
<div class="modal-content">
    <h4>Voeg een evenement toe</h4>
    <hr>
</div>


<div class="container">

    <div id="teacher{{$teacher->id}}" class="col s12">
        <table class="table">
            <thead>
            <tr>
            {!! $teacher->timesHtml !!}
            </tr>
            </thead>
        </table>
    </div>

    <div class="input-field" id="times">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn waves-effect waves-light " id="lesson_date_save">{{trans('form.button.save')}}</button>
    </div>
</div>

<script>
    var teacher = {!! json_encode($teacher) !!}
</script>