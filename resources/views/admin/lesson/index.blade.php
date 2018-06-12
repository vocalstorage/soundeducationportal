@extends('admin.layouts.master')

@section('content')

    <div class="item">
        <div class="row">
            <div class="col s12">
                <div style="float:left;"><h1 class="h2 ">Lessons</h1> <a href="create">Create a new lesson</a></div>
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
                            <th>#</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($lessons as $lesson)
                            @if(!empty($lesson->removeLessonDates()))
                                <div class="removed_lessondate" data-removedamount="{{$lesson->removeLessonDates()}}"
                                     style="display: none"></div>
                            @endif
                            <tr>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->max_registration}}</td>
                                <td>{{$lesson->deadline}}</td>
                                <td>{{$lesson->lessonDates->count() - $lesson->removeLessonDates()}}</td>
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
                                    <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="confirm_delete">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                                <td>
                                    @if(!$lesson->checkEmptyDates()->isEmpty())
                                        <a class="btn yellow lighten-1 waves-effect pulse modal-trigger"
                                           href="#modal{{$lesson->id}}">WARNING</a>
                                        <div id="modal{{$lesson->id}}" class="modal">
                                            <form action="{{route('admin-lessonDate-multipleDelete')}}" method="post">
                                                {{csrf_field()}}
                                                <h4>Er zijn zojuist {{$lesson->checkEmptyDates()->count()}} lege lesson
                                                    gevonden</h4>
                                                <div class="modal-content">
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
                                                                            <input type="checkbox"
                                                                                   value="{{$lessonDate->id}}"
                                                                                   name="delete[]"/>
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
                                                    <a href="#!" class="modal-close waves-effect waves-green btn">Cancel</a>
                                                    <button class="btn waves-effect waves-light" type="submit"
                                                            name="action">Remove
                                                        <i class="material-icons right">delete</i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    @if($lesson->lessonDates->count() === 0)
                                            <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="confirm_delete btn waves-effect red lighten-1 pulse">
                                                Verwijder
                                            </a>
                                    @endif
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