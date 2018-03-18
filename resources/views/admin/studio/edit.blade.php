@extends('admin.layouts.master')

@section('content')

    <div class="col-md-3" id="createLessonContainer" style=" padding: 50px">
        <form  action="/admin/studio/update/{{$studio->id}}" method="post">

            {{csrf_field()}}

            @include('admin.layouts.errors')

            <div class="form-group">
                <label>Studio name</label>
                <input value="{{$studio->name}}" type="text" class="form-control" placeholder="Enter studio name" name="name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="5" name="description">{{$studio->description}}</textarea>
            </div>
            <div class="form-group">
                <label>Place</label>
                <input value="{{$studio->place}}" type="text" class="form-control"  placeholder="Enter place" name="place">
            </div>
            <div class="form-group">
                <label >Street</label>
                <input value="{{$studio->street}}" type="text" class="form-control"  placeholder="Enter street" name="street">
            </div>
            <div class="form-group">
                <label>Postal code</label>
                <input value="{{$studio->postal_code}}" type="text" class="form-control"  placeholder="Enter postal_code" name="postal_code">
            </div>
            <div class="form-group">
                <label >Belongs to:</label>
                <select class="form-control" name="teacher_id">
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection