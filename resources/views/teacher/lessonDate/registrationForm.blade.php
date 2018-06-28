<div class="modal-content">
    <h4>{{$lessonDate->lesson->title}} - {{$lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDate->time}}</h4>
    <div class="divider"></div>
</div>

<div class="container">
    <div class="registrated-studends left-align">
        <ul class="studentRegistrations">
            <label>Students:</label>
            <li>
                @if(count($lessonDate->lessonDateRegistrations ) > 0)
                    @foreach($lessonDate->lessonDateRegistrations as $lessonDateRegistration)
                        <div class="chip">
                            {{$lessonDateRegistration->student->name}}
                            ({{$lessonDateRegistration->skill}})
                            <label>
                                <input data-id="{{$lessonDateRegistration->id}}" type="checkbox" class="presence checkbox{{$lessonDateRegistration->id}}" @if($lessonDateRegistration->presence) checked @endif  id="presence_"/>
                                <span>Aanwezig</span>
                            </label>
                        </div>
                    @endforeach
                @else
                    No students found
                @endif
            </li>
        </ul>
    </div>
</div>