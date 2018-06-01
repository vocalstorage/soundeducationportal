@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Create Teacher</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="/admin/teacher/store" onsubmit="return validateForm()" method="post">

                {{csrf_field()}}

                @include('admin.layouts.errors')

                <div class="input-field">
                    <input id="name" type="text" class="validate" placeholder="Enter name" name="name">
                    <label for="name">Name:</label>
                </div>

                <div class="input-field">
                    <input id="email" type="email" class="validate" placeholder="Enter email" name="email">
                    <label for="email">email:</label>
                </div>
                <div class="input-field">
                    <label for="color" class="active">Color:</label>
                    <input type='color' name='color' id="color" class="colorpicker"/>
                </div>

                <div class="input-field">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection