@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create teacher</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="/admin/teacher/store" onsubmit="return validateForm()" method="post">

                {{csrf_field()}}

                @include('admin.layouts.errors')

                <div class="input-field">
                    <label>Name:</label>
                    <input type="text" class="form-control" placeholder="Enter firstname" name="name">
                </div>
                <div class="input-field">
                    <label for="color" class="active">Teacher color:</label>
                    <input type='color' name='color' id="color" class="colorpicker"/>
                </div>

                <div class="input-field">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection