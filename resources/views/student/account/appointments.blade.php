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
                                    <div class="message {{$errors->has('comment')  && Session('lessonDateRegistrationId') == $lessonDateRegistration->id ? 'display-none' : '' }}" id="message-{{$lessonDateRegistration->id}}">
                                        @if($lessonDateRegistration->presence)
                                            <i class="material-icons large">done</i>
                                            <h1 class="center-align animated zoomIn">Aanwezig</h1>
                                        @else
                                            <i class="material-icons red-text lighten-1 large">clear</i>
                                            <h1 class="center-align animated zoomIn red-text lighten-1">Niet
                                                aanwezig</h1>
                                            <br/>
                                            <div class="container">
                                                <div class="col s12">
                                                    <p class="center-align">
                                                        <button class="btn waves-effect red lighten-1 btn-comment" data-id="{{$lessonDateRegistration->id}}">
                                                            Plaats een opmerking
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="comment {{$errors->has('comment') && Session('lessonDateRegistrationId') == $lessonDateRegistration->id ? '' : 'display-none' }}" id="comment-{{$lessonDateRegistration->id}}">
                                        <form action="{{route('student-registration-update', $lessonDateRegistration->id)}}"
                                              onsubmit="return validateForm()" method="post">
                                            {{csrf_field()}}
                                            <h3 class="center-align animated zoomIn white-text">Plaats een opmerking</h3>
                                            <div class="input-field col s12">
                                            <textarea id="comment" class="materialize-textarea white-text validate {{$errors->has('comment') ? ' invalid' : '' }}" name="comment" minlength="5" required></textarea>
                                            @if ($errors->has('comment'))
                                                <span class="helper-text helper-comment left"
                                                      data-error="{{ $errors->first('comment') }}"></span>
                                            @endif
                                            </div>
                                            <div class="col s6">
                                                <button class="btn waves-effect red lighten-1 left btn-comment" data-id="{{$lessonDateRegistration->id}}">Terug
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
                                <h5>{{$lessonDateRegistration->lessonDate->lesson->title}} -
                                    ({{$lessonDateRegistration->lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDateRegistration->lessonDate->time}})
                                </h5>
                                <ul>
                                    <label>Studenten:</label>
                                    <div class="divider"></div>
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
                                <div class="divider"></div>
                                <div class="wrapper-location-data">
                                    <div class="row">
                                        <div class="col s6">
                                            <h5 style="margin-top: 0">Gegevens</h5>
                                            <p>
                                                Straat: {{$lessonDateRegistration->lessonDate->teacher->studio->street}}</p>
                                            <p>
                                                Plaats: {{$lessonDateRegistration->lessonDate->teacher->studio->place}}</p>
                                            <p id="zipcode">
                                                Postcode: {{$lessonDateRegistration->lessonDate->teacher->studio->postal_code}}</p>
                                        </div>
                                        <div class="col s6">
                                            <h5 style="margin-top: 0">Reisplannen</h5>
                                            <a target="_blank"
                                               class="link-9292 waves-effect  float-right"
                                               href="https://9292.nl/?naar={{strtolower($lessonDateRegistration->lessonDate->teacher->studio->place)}}_{{strtolower($lessonDateRegistration->lessonDate->teacher->studio->street)}}-{{$lessonDateRegistration->lessonDate->teacher->studio->number}}">
                                                <img src="https://9292.nl/gimmage/N2/DefaultTemplate/Plan%20mijn%20OV-reis.png"
                                                     class="responsive-img">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($lessonDateRegistration->mayCancel())
                                <div class="card-action">
                                    <a href="{{route('student-registration-delete',$lessonDateRegistration->id)}}" class="btn waves-effect swal-show-warning-confirm"
                                       data-title="Weet je zeker dat je wilt uitschrijven?"
                                       data-confirm="Ja, schrijf mij uit"
                                       data-message="{{$lessonDateRegistration->warnings()}}"
                                       data-loading-message="Aan het uitschrijven">Uitschrijven</a>
                                </div>
                            @else
                                <div class="card-action">
                                    <a href="#" class="btn waves-effect swal-show-warning"
                                       data-message="{{$lessonDateRegistration->errors()}}"
                                       data-title="Uitschijven niet meer mogelijk"
                                       data-confirm="Oke">Uitschrijven (Uitgeschakeld)</a>
                                </div>
                            @endif
                        </div>
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