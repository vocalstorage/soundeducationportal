<div class="modal-content">
    <h4>Synthe les</h4>
    <hr>
</div>

<div class="container">
    {{$lessonDate->lesson->title}}
    <hr>
    <ul>
        <label>Info:</label>
        <li>Datum:{{$lessonDate->date}}</li>
        <li>Tijd: {{$lessonDate->time}}/li>
    </ul>
    <hr>
    <div class="registrated-studendts left-align">
        <ul>
            <label>Students:</label>
            <li>
                @if(count($lessonDate->lessonDateRegistrations ) > 0)
                @foreach($lessonDate->lessonDateRegistrations as $lessonDateRegistration)
                    <div class="chip">
                        {{$lessonDateRegistration->student->name}}
                        ({{$lessonDateRegistration->skill}})
                    </div>
                @endforeach
                @else
                No students found
                @endif
            </li>
        </ul>
    </div>
    <hr>
    <div class="input-field">
        <select id="skill-field" name="skill" class="validate" required>
            <option value="0" disabled selected>Choose your option</option>
            <option value="1">Beginner</option>
            <option value="2">Intermediate</option>
            <option value="3">Advanced</option>
        </select>
        <label>Choose your skill level</label>
    </div>
    <div class="modal-footer">
        <form action="">
            <a href="#!" class="modal-action btn  waves-effect green lighten-1 lessonDateRegisterBtn" id="{{$lessonDate->id}}">Make appointment</a>
        </form>
    </div>
</div>