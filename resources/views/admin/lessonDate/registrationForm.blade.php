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
        <a href="#" class="lessondate_register"><i class="material-icons ">add</i></a>
        <div class="studentSearchForm">
            <input type="text" id="studentSearchInput" placeholder="Search for names.." title="Type in a name">
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td><a href="{{route('admin-lessonDate-registerStudent',array($lessonDate->id, $student->id))}}"><i class="material-icons ">add</i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="modal-footer">

            <a href="{{route('admin-lessonDate-delete', $lessonDate->id)}}" class="modal-action btn  waves-effect green lighten-1 lessondate_delete">Verwijder</a>
    </div>
</div>