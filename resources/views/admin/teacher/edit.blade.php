@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Edit teacher</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-teacher-update', $teacher->id)}}" onsubmit="return validateForm('Editing teacher')" method="post">

                {{csrf_field()}}

                @include('admin.layouts.errors')

                <div class="input-field">
                    <label>Name:</label>
                    <input value="{{$teacher->name}}" type="text" class="form-control" placeholder="Enter firstname" name="name">
                </div>
                <div class="row">
                    <div class="col s6">
                         <div class="input-field">
                            <input name='color' id="color" type="text" class="colorpicker validate {{ $errors->has('color') ? ' invalid' : $teacher->color }}" value="{{old('color') ? old('color') : $teacher->color}}" required/>
                            {{--<input type="text" id="color" class="validate {{ $errors->has('color') ? ' invalid' : '' }}"  style="display: none"/>--}}
                            @if ($errors->has('color'))
                                <span class="helper-text" data-error="{{ $errors->first('color') }}"></span>
                            @endif
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
                    <button type="submit" class="btn  waves-effect">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<div style="display:block;" id="data" data-takenColors="{{json_encode($teachers->pluck('color')->toArray())}}"></div>

<script>
    var data = document.getElementById('data');
    var takenColors = JSON.parse(data.dataset.takencolors);

</script>