@extends('admin.layouts.master')

@section('content')
    <div class="col-md-6" id="createLessonContainer" style=" padding: 50px">
        <form  action="/admin/teacher/store" method="post">

            {{csrf_field()}}

            @include('admin.layouts.errors')

            <div class="form-group">
                <label>Firstname:</label>
                <input type="text" class="form-control"  placeholder="Enter firstname" name="name">
            </div>
            <div class="form-group">
                <label>Prefix:</label>
                <input type="text" class="form-control"  placeholder="Enter firstname" name="prefix">
            </div>
            <div class="form-group">
                <label>Lastname:</label>
                <input type="text" class="form-control"  placeholder="Enter lastname" name="lastname">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection