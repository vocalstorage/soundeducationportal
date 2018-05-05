<div class="form-group" style="margin-top: 2%">
        <div class="form-group">
            <label>Teacher</label>
            <select class="form-control" id="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
        </div>
</div>
<div class="form-group">
    <label>Date</label>
    <input id="datepicker" class="form-control" readonly>
</div>


<div class="form-group" id="deadlineForm" style="display: none">
    <label>Deadline</label>
    <input type="number" class="form-control" id="deadlineNr" min="1" max="20">
</div>


<div class="form-group" id="times">
    <table class="table">
        <thead>
        <tr>
            {!! $times !!}
        </tr>
        </thead>
    </table>
</div>

<div class="form-group" id="form-lesson_date_update" style="display: none">
    <button type="button" class="btn waves-effect waves-light green lighten-1" id="btnAddDateUpdate">Edit</button>
    <button type="button" class="btn waves-effect waves-light green lighten-1" id="btnAddDateCancel">Cancel</button>
</div>