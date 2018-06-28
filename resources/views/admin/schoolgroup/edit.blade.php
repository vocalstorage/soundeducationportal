@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">{{trans('modules/schoolgroup.function.edit')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-schoolgroup-update', $schoolgroup->id)}}" method="post">
                {{csrf_field()}}
                <div class="input-field col s12">
                    <input id="schoolgroup" value="@if(old('title')){{old('title')}}@else {{$schoolgroup->title}}@endif" type="text"
                           class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title">
                    <label for="title">Klas naam</label>
                    @if ($errors->has('class'))
                        <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button id="createSchoolgroup" type="submit" class="btn waves-effect show-swal-loading" data-message="Editing klass">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection