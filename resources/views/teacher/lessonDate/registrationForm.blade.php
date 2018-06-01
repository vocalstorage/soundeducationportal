<div class="modal-content">
    <h4>    {{$lessonDate->lesson->title}}</h4>
    <hr>
</div>

<div class="container">
    <ul>
        <label>Info:</label>
        <li>Datum:{{$lessonDate->date}}</li>
        <li>Tijd: {{$lessonDate->time}}</li>
    </ul>
    <hr>
    <div class="registrated-studendts left-align">
        <ul class="studentRegistrations">
            <label>Students:</label>
            <li>
                @if(count($lessonDate->lessonDateRegistrations ) > 0)
                    @foreach($lessonDate->lessonDateRegistrations as $lessonDateRegistration)
                        <div class="chip">
                            {{$lessonDateRegistration->student->name}}
                            ({{$lessonDateRegistration->skill}})
                            <a href="{{route('admin-lessonDate-cancelStudent',array($lessonDate->id, $lessonDateRegistration->id))}}'" class="lessondate_cancelStudent"><i class="material-icons ">clear</i></a>
                        </div>
                    @endforeach
                @else
                    No students found
                @endif
            </li>
        </ul>
    </div>
</div>