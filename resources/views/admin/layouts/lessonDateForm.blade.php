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
        <input id="datepicker" class="form-control">
    @endif
</div>

@if($view == 'create')
<div class="form-group" id="deadlineForm">
    <label>Deadline</label>
    <input type="number" class="form-control" id="deadlineNr">
</div>
@endif

<div class="form-group" @if(!$lesson_date)style="display: none" @endif id="times">
    <table class="table">
        <tbody>
        <tr>
            {!! $times !!}
        </tr>
        </tbody>
    </table>
</div>

@if(!$lesson_date)
<div class="row">
    <div class="form-group" id="formCreateLesson">

    </div>
</div>
@endif