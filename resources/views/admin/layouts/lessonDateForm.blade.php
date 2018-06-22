<div class="input-field" style="margin-top: 2%">
   @if($view == 'edit')
        {{$teacher->name}}
        <input id="teacher_id" type="text" value="{{$teacher->id}}">
    @else
        <div class="input-field">
            <label>Teacher</label>
            <select class="form-control" id="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
<div class="input-field">
    @if($view == 'edit') {{$lesson_date->date}}   @else
        <label>Date</label>
        <input id="datepicker" class="form-control" readonly>
    @endif
</div>
<div class="input-field" @if(!$lesson_date)style="display: none" @endif id="times">
    <table class="table">
        <thead>
        <tr>
            {!! $times !!}
        </tr>
        </thead>
    </table>
</div>

    <div class="input-field" id="form-lesson_date_update" style="display: none">
    <button type="button" class="btn waves-effect waves-light " id="btnAddDateUpdate">Edit</button>
    <button type="button" class="btn waves-effect waves-light " id="btnAddDateCancel">Cancel</button>
</div>

@if(!$lesson_date)
<div class="row">
    <div class="input-field" id="formCreateLesson">

    </div>
</div>
@endif