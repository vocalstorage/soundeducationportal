@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create Studio</h1></div>
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
                <div class="row">
                    <div class="input-field col s5">
                        <label>Place</label>
                        <input type="text" class="validate" placeholder="Enter place" name="place">
                    </div>
                    <div class="input-field col s5">
                        <label>Street</label>
                        <input type="text" class="validate" placeholder="Enter street" name="street">
                    </div>
                    <div class="input-field col s2">
                        <label>Number</label>
                        <input type="text" class="validate" placeholder="Enter number" name="number">
                    </div>
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
                <label>Image:</label>
                <div class="file-field input-field col s10">
                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                        <div class="btn green lighten-1 waves-effect">
                            <i class="material-icons">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                </div>
                <div class="col s2">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection