@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1>{{trans('modules/teacher.function.edit')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-teacher-update', $teacher->id)}}"  method="post">

                {{csrf_field()}}

                <div class="input-field">
                    <label>{{trans('form.label.name')}}</label>
                    <input value="{{old('name') ? old('name') : $teacher->name}}" type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}"  name="name">
                    @if ($errors->has('name'))
                        <span class="helper-text" data-error="{{ $errors->first('name') }}"></span>
                    @endif
                </div>
                <div class="input-field">
                    <input id="email" type="email"  class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{old('email') ? old('email') : $teacher->email}}">
                    <label for="email">{{trans('form.label.email')}}</label>
                    @if ($errors->has('email'))
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
                <div class="row">
                    <div class="col s6">
                         <div class="input-field">
                            <input name='color' id="color" type="text" class="colorpicker validate {{ $errors->has('color') ? ' invalid' : $teacher->color }}" value="{{old('color') ? old('color') : $teacher->color}}" />
                             <label for="name">{{trans('form.label.color')}}</label>
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
                    <button type="submit" class="btn  waves-effect show-swal-loading" data-message="Leraar aan het aanpassen">{{trans('form.button.save')}}</button>
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