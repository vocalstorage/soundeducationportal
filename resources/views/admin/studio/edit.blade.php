@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Edit Studio</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-studio-update', $studio->id)}}" onsubmit="return validateForm()" method="post">
                {{csrf_field()}}

                @include('admin.layouts.errors')

                <div class="input-field">
                    <label>Studio name</label>
                    <input value="{{$studio->name}}" type="text" class="form-control" placeholder="Enter studio name"
                           name="name">
                </div>

                <label class="active" for="description_value">description:</label>
                <div id="description"></div>
                <input value="{{$studio->description}}" id="description_value" type="hidden" name="description">

                <div class="input-field">
                    <label>Place</label>
                    <input value="{{$studio->place}}" type="text" class="form-control" placeholder="Enter place"
                           name="place">
                </div>
                <div class="input-field">
                    <label>Street</label>
                    <input value="{{$studio->street}}" type="text" class="form-control" placeholder="Enter street"
                           name="street">
                </div>
                <div class="input-field">
                    <label>Postal code</label>
                    <input value="{{$studio->postal_code}}" type="text" class="form-control"
                           placeholder="Enter postal_code" name="postal_code">
                </div>
                <div class="input-field">
                    <select name="teacher_id">
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                    <label>Belongs to:</label>
                </div>
                <label>Image:</label>
                <div class="file-field input-field col s10">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <div class="btn green lighten-1 waves-effect">
                            <i class="material-icons">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="form-control" type="text" name="filepath"  value="{{$studio->filepath->path}}">
                    </div>
                </div>
                <div class="col s2">
                    <img src="{{$studio->filepath->path}}" id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn green lighten-1 waves-effect">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection