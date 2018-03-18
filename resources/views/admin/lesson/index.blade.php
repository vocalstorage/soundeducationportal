@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"><h1 class="h2">Lessons</h1> <a href="create">Create a new lesson</a></div>
            </div>
        </div>
        <div id="accordion">
        <table class="table table-striped " style="margin-top: 2%"  cellspacing="0">
            <thead>
            <tr>
                <th>Lesson Title</th>
                <th>Description</th>
                <th>Max</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{$lesson->title}}</td>
                    <td>{{$lesson->description}}e</td>
                    <td>{{$lesson->max_registration}}</td>
                    <td><button class="btn btn-primary btnShowLessonDates" type="button" data-toggle="collapse" data-target="#showLessonDates{{$lesson->id}}" aria-expanded="false" aria-controls="collapseExample" id="{{$lesson->id}}">
                            Show dates
                        </button>
                    </td>
                </tr>
                <tr style="display: none; line-height:0px;font-size:0px;height:0px;margin:0;padding:0" id="trShowLessonDates{{$lesson->id}}">
                    <td colspan="5">
                        <div class="collapse" id="showLessonDates{{$lesson->id}}" data-parent="#accordion">
                            <table class="table table-striped " style="margin-top: 2%">
                                <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                    <th>Deadline</th>
                                    <th>Time</th>
                                    <th>Registrations</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lesson->lessonDates as $date)
                                    <?php
                                    if($lastDate == "empty" || $lastLessonId !== $lesson->id){
                                        echo '<tr><td colspan="7" style="background-color: forestgreen; color:white">'.date('Y-m-d',strtotime($date->date)).'</td></tr>';

                                    }elseif($date->date !== $lastDate){
                                        echo '<tr><td colspan="7" style="background-color: forestgreen; color:white">'.date('Y-m-d',strtotime($date->date)).'</td></tr>';
                                    }
                                    $lastDate = $date->date;
                                    $lastLessonId = $lesson->id;
                                    ?>
                                    <tr>
                                        <td>{{$date->teacher->first()->name}} {{$date->teacher->first()->prefix}} {{$date->teacher->first()->lastname}}</td>
                                        <td>{{date('Y-m-d',strtotime($date->date))}}</td>
                                        <td>{{$date->deadline}}</td>
                                        <td>{{$date->time}}</td>
                                        <td>{{$date->registrations}}</td>
                                        <td><a href="#" id="{{$date->id}}" class="lesson_date_edit">edit</a></td>
                                        <td><a href="/admin/lesson/delete/{{$date->id}}">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
        </div>
        {{$lessons->links() }}
    </main>
    <div class="container" style="width: 80%">
        <!-- Modal -->
        <div class="modal fade" id="lesson_date_form" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="lesson_date_update" data-dismiss="modal">Edit</button>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection