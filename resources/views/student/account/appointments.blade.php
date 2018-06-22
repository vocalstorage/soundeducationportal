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
                @if( empty($lessonDateRegistration->comment))
                    <div class="col l6 x12" style="position: relative">
                        <div class="card">
                            @if($lessonDateRegistration->lessonDate->date->isPast())
                                <div class="overlay waves-effect grey darken-4"></div>
                                <div class="overlay-content animated fadeIn">
                                    <div class="message {{$errors->has('comment') ? 'display-none' : '' }}">
                                        @if($lessonDateRegistration->presence)
                                            <i class="material-icons material-icons-big">done</i>
                                            <h1 class="center-align animated zoomIn">Aanwezig</h1>
                                        @else
                                            <i class="material-icons material-icons-big red-text lighten-1">clear</i>
                                            <h1 class="center-align animated zoomIn red-text lighten-1">Niet
                                                aanwezig</h1>
                                            <br/>
                                            <div class="container">
                                                <div class="col s12">
                                                    <p class="center-align">
                                                        <button class="btn waves-effect red lighten-1 btn-comment">
                                                            Plaats een opmerking
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="comment {{$errors->has('comment') ? '' : 'display-none' }}">
                                        <form action="{{route('student-registration-update', $lessonDateRegistration->id)}}"
                                              onsubmit="return validateForm()" method="post">
                                            {{csrf_field()}}
                                            <h3 class="center-align animated zoomIn white-text">Plaats een
                                                opmerking</h3>
                                            <textarea id="comment"
                                                      class="materialize-textarea white-text validate {{$errors->has('comment') ? ' invalid' : '' }}"
                                                      name="comment" minlength="5" required></textarea>
                                            @if ($errors->has('comment'))
                                                <span class="helper-text left"
                                                      data-error="{{ $errors->first('comment') }}"></span>
                                            @endif
                                            <div class="col s6">
                                                <button class="btn waves-effect red lighten-1 left btn-comment">Terug
                                                </button>
                                            </div>
                                            <div class="col s6">
                                                <button type="submit" class="btn waves-effect red lighten-1 right">
                                                    Plaats opmerking
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="card-image">
                                <img src="{{$lessonDateRegistration->lessonDate->teacher->studio->filepath->path}}"
                                     alt="img">
                            </div>
                            <div class="card-content">
                                <h3>{{$lessonDateRegistration->lessonDate->lesson->title}}
                                    ({{date_format(new DateTime($lessonDateRegistration->lessonDate->date),'l\, jS F \a\t '. $lessonDateRegistration->lessonDate->time)}}
                                    )
                                </h3>
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
                                            <p>
                                                Straat: {{$lessonDateRegistration->lessonDate->teacher->studio->street}}</p>
                                            <p>
                                                Plaats: {{$lessonDateRegistration->lessonDate->teacher->studio->place}}</p>
                                            <p id="zipcode">
                                                Postcode: {{$lessonDateRegistration->lessonDate->teacher->studio->postal_code}}</p>
                                        </div>
                                        <div class="col s6">
                                            <h4 style="margin-top: 0">Reisplannen</h4>
                                            <a target="_blank"
                                               class="btn link-9292 waves-effect  float-right"
                                               href="https://9292.nl/?naar={{strtolower($lessonDateRegistration->lessonDate->teacher->studio->place)}}_{{strtolower($lessonDateRegistration->lessonDate->teacher->studio->street)}}-{{$lessonDateRegistration->lessonDate->teacher->studio->number}}">
                                                <img src="https://9292.nl/gimmage/N2/DefaultTemplate/Plan%20mijn%20OV-reis.png"
                                                     class="responsive-img">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(is_int($lessonDateRegistration->mayCancel()))
                                <div class="card-action">
                                    <a href="{{route('student-registration-delete',$lessonDateRegistration->id)}}"
                                       class="btn lessonDateCancelBtn waves-effect "
                                       data-cancelled="{{$lessonDateRegistration->mayCancel()}}">Uitschrijven</a>
                                </div>
                            @else
                                <div class="card-action">
                                    <a href="#" class="tooltipped btn waves-effect " data-delay="50" data-position="top"
                                       data-tooltip="{{$lessonDateRegistration->mayCancel()}}">
                                        Uitschrijven
                                        (DISABLED)</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div>
                        <h5 class="center-align">Geen afspraken gevonden</h5>
                    </div>
                @endif
            @endforeach
        @else
            <div>
                <h5 class="center-align">Geen afspraken gevonden</h5>
            </div>
        @endif
    </div>
@endsection