<div class="modal-content">
    <h4>{{$lessonDate->lesson->title}} ({{$lessonDate->teacher->studio->name}}) - {{$lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDate->time}}</h4>
    <hr>
    <br>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="registrated-studendts left-align">
                    <ul>
                        <label>Studenten:</label>
                        <div class="divider"></div>
                        <li>
                            @if(count($lessonDate->lessonDateRegistrations ) > 0)
                                @foreach($lessonDate->lessonDateRegistrations as $lessonDateRegistration)
                                    <div class="chip">
                                        {{$lessonDateRegistration->student->name}}
                                        ({{$lessonDateRegistration->skill}})
                                    </div>
                                @endforeach
                            @else
                                Geen studenten kunnen vinden.
                            @endif
                        </li>
                    </ul>
                </div>
                <br>
                <div class="input-field">
                    <select id="skill-field" name="skill" class="validate" required="required">
                        <option value="" disabled selected>Kies een niveau</option>
                        <option value="1">Beginner</option>
                        <option value="2">Gemiddeld</option>
                        <option value="3">Gevorderd</option>
                    </select>
                    <label data-error="Select an option">Kies je niveau</label>
                </div>
                <div class="modal-footer">
                    <form action="">
                        <a href="#!" class="modal-action btn  waves-effect  lessonDateRegisterBtn col s12 l3 right"
                           data-id="{{$lessonDate->id}}">Afspraak
                            maken</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
