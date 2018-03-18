@extends('admin.layouts.master')

@section('content')

    <div class="col-md-6" id="createLessonContainer" style=" padding: 50px">
        <form  action="/admin/teacher/update/{{$teacher->id}}" method="post">

            {{csrf_field()}}

            @include('admin.layouts.errors')

            <div class="form-group">
                <label>Firstname:</label>
                <input value="{{$teacher->name}}" type="text" class="form-control"  placeholder="Enter firstname" name="name">
            </div>
            <div class="form-group">
                <label>Prefix:</label>
                <input value="{{$teacher->prefix}}" type="text" class="form-control"  placeholder="Enter firstname" name="prefix">
            </div>
            <div class="form-group">
                <label>Lastname:</label>
                <input value="{{$teacher->lastname}}" type="text" class="form-control"  placeholder="Enter lastname" name="lastname">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection