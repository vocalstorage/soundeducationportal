<div class="modal-content">
    <h4>{{$lessonDate->lesson->title}} - {{$lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDate->time}}</h4>
    <div class="divider"></div>
</div>

<div class="container">
    <div class="registrated-students left-align">
        <ul class="studentRegistrations">
            <label>{{trans('modules/student.title')}}</label>
            <div class="divider"></div>
            <li>
                @if(count($lessonDate->lessonDateRegistrations ) > 0)
                    @foreach($lessonDate->lessonDateRegistrations as $lessonDateRegistration)
                        <div class="chip">
                            {{$lessonDateRegistration->student->name}}
                            ({{$lessonDateRegistration->skill}})
                            <a href="{{route('admin-lessonDate-cancelStudent',array($lessonDate->id, $lessonDateRegistration->id))}}'"
                               class="swal-show-warning" data-message="Wil je student {{$lessonDateRegistration->student->name}} uitschrijven?"
                               data-loading-message="Student aan het uitschrijven"><i class="material-icons ">clear</i></a>

                        </div>
                    @endforeach
                @else
                    Er zijn nog geen registraties.
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
                        <td><a href="{{route('admin-lessonDate-registerStudent',array($lessonDate->id, $student->id))}}" class="show-swal-loading" data-message="Student aan het inschrijven"><i class="material-icons ">add</i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="modal-footer">
        <a href="{{route('admin-lessonDate-delete',$lessonDate->id)}}" class="btn swal-show-warning" data-message="{{$lessonDate->warnings()}}" data-loading-message="Deleting lesson">
            {{trans('form.button.delete')}}
        </a>
    </div>
</div>