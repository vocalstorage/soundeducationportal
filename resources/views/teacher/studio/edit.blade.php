
    <form id="studio-form" class="col s12" action="{{route('teacher-studio-update')}}" onsubmit="return validateForm('#studio-form')" method="post">
        {{csrf_field()}}
        <div class="row">
            <h4>Studio</h4>
            <div class="input-field col s12">
                <label>Studio name</label>
                <input type="text" class="validate" placeholder="Enter studio name" name="studio-name"
                       value="@if(old('name')){{old('name')}} @else {{$studio->name}} @endif">
            </div>
            <div class="input-field col s12">
                <label class="active" for="description_value">Description</label>
                <div id="description"></div>
                <input id="description_value" type="hidden" name="description"
                       value="@if(old('name')){{old('name')}} @else {{$studio->description}} @endif">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s5">
                <label>Place</label>
                <input type="text" class="validate" placeholder="Enter place" name="place"
                       value="@if(old('place')){{old('place')}} @else {{$studio->place}} @endif">
            </div>
            <div class="input-field col s5">
                <label>Street</label>
                <input type="text" class="validate" placeholder="Enter street" name="street"
                       value="@if(old('street')){{old('street')}} @else {{$studio->street}} @endif">
            </div>
            <div class="input-field col s2">
                <label>Number</label>
                <input type="text" class="validate" placeholder="Enter number" name="number"
                       value="@if(old('number')){{old('number')}} @else {{$studio->number}} @endif">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label>Postal code</label>
                <input type="text" class="validate" placeholder="Enter postal_code" name="postal_code"
                       value="@if(old('postal_code')){{old('postal_code')}} @else {{$studio->postal_code}} @endif">
            </div>
        </div>
        <div class="input-field">
            <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
        </div>
    </form>
