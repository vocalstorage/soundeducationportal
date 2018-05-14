@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Edit teacher</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-teacher-update', $teacher->id)}}" onsubmit="return validateForm()" method="post">

                {{csrf_field()}}

                @include('admin.layouts.errors')

                <div class="input-field">
                    <label>Name:</label>
                    <input value="{{$teacher->name}}" type="text" class="form-control" placeholder="Enter firstname" name="name">
                </div>
                <div class="row">
                    <div class="col s6">
                        <div class="input-field">
                            <label for="color" class="active">Teacher color:</label>
                            <input class="colorpicker" type='color' name='color' id="color" value="{{$teacher->color}}"/>
                        </div>
                    </div>
                    <div class="col s6">
                        <label>Taken colors:</label>
                        <ul class="horizontal-list">
                            @foreach($teachers as $otherTeachers)
                                <li>
                                    <div class="color-box  @if($otherTeachers->color == $teacher->color) pulse @endif " style="background-color: {{$otherTeachers->color}}"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="input-field">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection