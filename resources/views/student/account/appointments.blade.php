@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Appointments</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                @if(count(\Auth::user()->lessonDateRegistrations) > 0)
                    @foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration)

                        <div class="col s6">
                            <div class="card">
                                <div class="card-image">
                                    <img src="http://via.placeholder.com/350x150" alt="img">
                                    <span class="card-title">{{$lessonDateRegistration->lessonDate->lesson->title}} ({{$lessonDateRegistration->lessonDate->date}}  {{$lessonDateRegistration->lessonDate->time}})</span>
                                </div>
                                <div class="card-content">
                                    <p>
                                        {{$lessonDateRegistration->lessonDate->lesson->description}}
                                    </p>

                                    <ul>
                                        <label>Students:</label>
                                        <li>
                                        @if(count($lessonDateRegistration->lessonDate->lessonDateRegistrations ) > 0)
                                            @foreach($lessonDateRegistration->lessonDate->lessonDateRegistrations as $lessonDateRegistration)

                                                    <div class="chip">
                                                        {{$lessonDateRegistration->student->name}}
                                                        ({{$lessonDateRegistration->skill}})
                                                    </div>

                                            @endforeach
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <a href="{{route('student-lessonDate-delete',$lessonDateRegistration->id)}}" class="btn lessonDateCancelBtn waves-effect green lighten-1">Uitschrijven</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h5 class="center-align">No appointments found</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection