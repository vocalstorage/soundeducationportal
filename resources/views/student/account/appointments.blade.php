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
                                ({{date_format(new DateTime($lessonDateRegistration->lessonDate->date),'l\, jS F \a\t '. $lessonDateRegistration->lessonDate->time)}})
                            </span>
                        </div>
                        <div class="card-content">
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
                            <hr>
                            <div class="wrapper-location-data">
                                <div class="row">
                                    <div class="col s6">
                                        <h4 style="margin-top: 0">Gegevens</h4>
                                        <p>Straat: {{$lessonDateRegistration->lessonDate->teacher->studio->street}}</p>
                                        <p>Plaats: {{$lessonDateRegistration->lessonDate->teacher->studio->place}}</p>
                                        <p id="zipcode">Postcode: {{$lessonDateRegistration->lessonDate->teacher->studio->postal_code}}</p>
                                    </div>
                                    <div class="col s6">
                                        <h4 style="margin-top: 0">Reisplannen</h4>
                                        <a target="_blank" class="btn link-9292 waves-effect green lighten-1 float-right" href="https://9292.nl/?naar={{strtolower($lessonDateRegistration->lessonDate->teacher->studio->place)}}_{{strtolower($lessonDateRegistration->lessonDate->teacher->studio->street)}}-{{$lessonDateRegistration->lessonDate->teacher->studio->number}}">
                                            <img src="https://9292.nl/gimmage/N2/DefaultTemplate/Plan%20mijn%20OV-reis.png" class="responsive-img">
                                        </a>
                                    </div>
                                </div>
                            </div>
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