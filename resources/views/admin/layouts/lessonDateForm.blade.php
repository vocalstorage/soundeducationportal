<div class="form-group" style="margin-top: 2%">
   @if($view == 'edit')
        {{$teacher->name}}
        <input id="teacher_id" type="text" value="{{$teacher->id}}">
    @else
        <div class="form-group">
            <label>Teacher</label>
            <select class="form-control" id="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
<div class="form-group">
    @if($view == 'edit') {{$lesson_date->date}}   @else
        <label>Date</label>
        <input id="datepicker" class="form-control" readonly>
    @endif
</div>

@if($view == 'create')
<div class="form-group" id="deadlineForm" style="display: none">
    <label>Deadline</label>
    <input type="number" class="form-control" id="deadlineNr" min="1" max="20">
</div>
@endif

<div class="form-group" @if(!$lesson_date)style="display: none" @endif id="times">
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

@if(!$lesson_date)
<div class="row">
    <div class="form-group" id="formCreateLesson">

    </div>
</div>
@endif