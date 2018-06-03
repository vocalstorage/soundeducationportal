@extends('student.layouts.master')
@section('content')
    <div class="row">
        <div class="col s12">
            <h3 style="margin: 0px">Afspraken</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        @if(count(\Auth::user()->lessonDateRegistrations) > 0)
            @foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration)
                <div class="col l6 x12">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{$lessonDateRegistration->lessonDate->teacher->studio->filepath->path}}"
                                 alt="img">
                            <span class="card-title">{{$lessonDateRegistration->lessonDate->lesson->title}}
                                ({{$lessonDateRegistration->lessonDate->date}}  {{$lessonDateRegistration->lessonDate->time}}
                                )</span>
                        </div>
                        <div class="card-content">
                            <p>
                                {{$lessonDateRegistration->lessonDate->lesson->description}}
                            </p>

                            <ul>
                                <label>Studenten:</label>
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

                        @if($lessonDateRegistration->mayCancel())
                            <div class="card-action">
                                <a href="{{route('student-lessonDate-delete',$lessonDateRegistration->id)}}"
                                   class="btn lessonDateCancelBtn waves-effect green lighten-1">Uitschrijven</a>
                            </div>
                        @else
                            <div class="card-action">
                                <a href="#" class="tooltipped btn waves-effect green lighten-1" data-position="bottom" data-tooltip="na 5 dagen kan er niet meer uitgeschreven worden">Uitschrijven
                                    (DISABLED)</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <h5 class="center-align">Geen afspraken gevonden</h5>
            </div>
        @endif
    </div>
@endsection