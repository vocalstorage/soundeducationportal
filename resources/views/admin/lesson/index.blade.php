@extends('admin.layouts.master')

@section('content')
    <div class="item">
        <div class="row">
            <div class="col s12">
                <div style="float:left;"><h1 class="h2 ">Lessons</h1>
                @if($teacherStudioRelations > 0)
                    <a href="{{route('admin-lesson-create')}}">Create a new Lesson</a>
                @else
                    <a href="{{route('admin-teacher-create')}}" class="tooltipped" data-position="bottom" data-tooltip="Please create a teacher first (click link to create)">Create a studio (DISABLED)</a>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="col s12">
                <div id="accordion">
                    <table class="table table-striped " style="margin-top: 2%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Lesson Title</th>
                            <th>Max</th>
                            <th>Deadline</th>
                            <th>Open dates</th>
                            <th>Class</th>
                            <th>Messages</th>
                            <th>#</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->max_registration}}</td>
                                <td>{{$lesson->deadline->format('d/m/Y')}}</td>
                                <td>{{$lesson->lessonDates->count() - $lesson->removeLessonDates()}}</td>
                                <td>{{$lesson->schoolgroup->title}}</td>
                                <td>
                                    @if(!$lesson->checkEmptyDates()->isEmpty())
                                        <a class="btn yellow darken-3 waves-effect pulse modal-trigger"
                                           href="#modal{{$lesson->id}}">WARNING</a>
                                        <div id="modal{{$lesson->id}}" class="modal">
                                            <form action="{{route('admin-lessonDate-handleWarnings')}}" method="post">
                                                {{csrf_field()}}

                                                <div class="modal-content">
                                                    <h3>{{$lesson->checkEmptyDates()->count()}} lessons found close to be empty</h3>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>Teacher</th>
                                                            <th>Date</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($lesson->checkEmptyDates() as $lessonDate)
                                                            <tr>
                                                                <td>{{$lessonDate->teacher->name}}</td>
                                                                <td>
                                                                    {{date_format(new DateTime($lessonDate->date),'l\, jS F \o\m '. $lessonDate->time)}}
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        <label>
                                                                            <input type="checkbox" value="{{$lessonDate->id}}" name="delete[]"/>
                                                                            <span></span>
                                                                        </label>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col s6"> <a href="#!" class="modal-close waves-effect  btn left">Later</a></div>
                                                    <div class="col s6">
                                                        <button class="btn waves-effect " type="submit"
                                                                name="action">Confirm
                                                        </button>
                                                    </div>


                                                </div>

                                                <input type="hidden" name="warnings[]" value="{{json_encode($lesson->checkEmptyDates()->pluck('id')->toArray())}}">
                                            </form>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin-lesson-show',$lesson->id)}}" class="lesson_show">
                                        <i class="material-icons">event_note</i>
                                    </a>
                                    <a href="{{route('admin-lesson-presence',$lesson->id)}}">
                                        <i class="material-icons">access_time</i>
                                    </a>
                                    <a href="{{route('admin-lesson-edit',$lesson->id)}}" >
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="confirm_delete" data-message="Deleting lesson: {{$lesson->name}}">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$lessons->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection