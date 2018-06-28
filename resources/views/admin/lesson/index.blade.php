@extends('admin.layouts.master')

@section('content')
    <div class="item">
        <div class="row">
            <div class="col s12">
                <div style="float:left;"><h1 class="h2 ">{{trans('modules/lesson.title')}}</h1>
                @if($teacherStudioRelations > 0)
                    <a href="{{route('admin-lesson-create')}}">{{trans('modules/lesson.function.create')}}</a>
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
                            <th>{{trans('form.label.title')}}</th>
                            <th>{{trans('form.label.max_registrations')}}</th>
                            <th>{{trans('form.label.deadline')}}</th>
                            <th>{{trans('form.label.open_date')}}</th>
                            <th>{{trans('form.label.class')}}</th>
                            <th>{{trans('form.label.messages')}}</th>
                            <th>#</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->max_registration}}</td>
                                <td>{{$lesson->deadline->format('d/m/Y')}}</td>
                                <td>{{$lesson->lessonDates->count()}}</td>
                                <td>{{$lesson->schoolgroup->title}}</td>
                                <td>
                                    @if(!$lesson->checkEmptyDates()->isEmpty())
                                        <a class="btn yellow darken-3 waves-effect pulse modal-trigger"
                                           href="#modal{{$lesson->id}}">{{trans('form.button.warning')}}</a>
                                        <div id="modal{{$lesson->id}}" class="modal">
                                            <form action="{{route('admin-lessonDate-handleWarnings')}}" method="post" data-swal-loading-message="Geselecteerde lessen aan het verwijderen">
                                                {{csrf_field()}}

                                                <div class="modal-content">
                                                    <h3>{{$lesson->checkEmptyDates()->count()}} lege lesson gevonden</h3>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans('modules/teacher.function.create')}}</th>
                                                            <th>{{trans('form.label.date')}}</th>
                                                            <th>{{trans('form.label.registrations')}}</th>
                                                            <th>
                                                                <label>
                                                                    <input type="checkbox" class="check-all"/>
                                                                    <span></span>
                                                                </label>
                                                                {{trans('form.button.remove')}}
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($lesson->checkEmptyDates() as $lessonDate)
                                                            <tr>
                                                                <td>{{$lessonDate->teacher->name}}</td>
                                                                <td>
                                                                    {{$lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDate->time}}
                                                                </td>
                                                                <td>{{$lessonDate->lessonDateRegistrations()->count()}}</td>
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
                                                <div class="col s6"> <a href="#!" class="modal-close waves-effect  btn left">{{trans('form.button.cancel')}}</a></div>
                                                    <div class="col s6">
                                                        <button class="btn waves-effect show-swal-loading" data-message="Waarschuwingen aan het verwerken" type="submit" name="action">
                                                            {{trans('form.button.save')}}
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
                                    <a href="{{route('admin-lesson-delete',$lesson->id)}}" class="swal-show-warning"
                                       data-message="{{$lesson->warnings()}}"
                                        data-loading-message="Deleting lesson">
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