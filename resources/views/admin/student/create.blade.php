@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Voeg klass toe</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-student-store')}}" onsubmit="return validateForm()" method="post">
                {{csrf_field()}}
                <label>Excel file:</label>
                <div class="file-field input-field col s10">
                    <a id="excelFilemanager" data-input="thumbnail" data-preview="holder">
                        <div class="btn green lighten-1 waves-effect">
                            <i class="material-icons">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                </div>
                <div class="input-field col s12">
                    <input id="class" value="@if(old('class')){{old('class')}}@endif" type="text"
                           class="validate {{ $errors->has('class') ? ' invalid' : '' }}" name="class" >
                    <label for="title">Klas naam</label>
                    @if ($errors->has('class'))
                        <span class="helper-text" data-error="{{ $errors->first('class') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection