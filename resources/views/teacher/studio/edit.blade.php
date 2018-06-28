
    <form id="studio-form" class="col s12" action="{{route('teacher-studio-update')}}" onsubmit="return validateForm('#studio-form')" method="post">
        {{csrf_field()}}
        <div class="row">
            <h4>Studio</h4>
            <div class="input-field col s12">
                <label>{{trans('form.label.title')}}</label>
                <input type="text" class="validate"  name="studio-name"
                       value="@if(old('name')){{old('name')}} @else {{$studio->name}} @endif">
            </div>
            <div class="input-field col s12">
                    <textarea name="description" id="editor" class="validate {{ $errors->has('description') ? ' invalid' : '' }}">
                        {{old('description') ? old('description') : $studio->description}}
                    </textarea>
                @if ($errors->has('description'))
                    <span class="helper-text red-text">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="input-field col s5">
                <label>{{trans('form.label.place')}}</label>
                <input type="text" class="validate" placeholder="Enter place" name="place"
                       value="@if(old('place')){{old('place')}} @else {{$studio->place}} @endif">
            </div>
            <div class="input-field col s5">
                <label>{{trans('form.label.street')}}</label>
                <input type="text" class="validate" placeholder="Enter street" name="street"
                       value="@if(old('street')){{old('street')}} @else {{$studio->street}} @endif">
            </div>
            <div class="input-field col s2">
                <label>{{trans('form.label.number')}}</label>
                <input type="text" class="validate" placeholder="Enter number" name="number"
                       value="@if(old('number')){{old('number')}} @else {{$studio->number}} @endif">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label>{{trans('form.label.zipcode')}}</label>
                <input type="text" class="validate" placeholder="Enter postal_code" name="postal_code"
                       value="@if(old('postal_code')){{old('postal_code')}} @else {{$studio->postal_code}} @endif">
            </div>
        </div>
        <div class="input-field">
            <button type="submit" class="btn waves-effect">{{trans('form.button.save')}}</button>
        </div>
    </form>
