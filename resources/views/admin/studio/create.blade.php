@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create studio</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="/admin/studio/store" onsubmit="return validateForm()" method="post">
                {{csrf_field()}}
                @include('admin.layouts.errors')

                <div class="input-field">
                    <label>Studio name</label>
                    <input type="text" class="validate" placeholder="Enter studio name" name="name">
                </div>
                <label class="active" for="description_value">description:</label>
                <div id="description"></div>
                <input id="description_value" type="hidden" name="description">


                <div class="input-field">
                    <label>Place</label>
                    <input type="text" class="validate" placeholder="Enter place" name="place">
                </div>
                <div class="input-field">
                    <label>Street</label>
                    <input type="text" class="validate" placeholder="Enter street" name="street">
                </div>
                <div class="input-field">
                    <label>Postal code</label>
                    <input type="text" class="validate" placeholder="Enter postal_code" name="postal_code">
                </div>
                <div class="input-field">
                    <select class="validate" name="teacher_id">
                        <option value="" disabled selected>Choose owner of studio</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                    <label>Owner:</label>
                </div>
                <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
            </form>
        </div>
    </div>
@endsection