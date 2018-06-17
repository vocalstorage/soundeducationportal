@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Voeg klass toe</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-schoolgroup-store')}}" onsubmit="return validateForm('Fetching excel data')" method="post">
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
                    <input id="schoolgroup" value="@if(old('schoolgroup')){{old('schoolgroup')}}@endif" type="text"
                           class="validate {{ $errors->has('schoolgroup') ? ' invalid' : '' }}" name="schoolgroup">
                    <label for="title">Klas naam</label>
                    @if ($errors->has('class'))
                        <span class="helper-text" data-error="{{ $errors->first('schoolgroup') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button id="createSchoolgroup" type="submit" class="btn green lighten-1 waves-effect">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @if (!empty($students) || !empty($failures))
        <h1>{{count($students) + count($failures) - count($failures) }} van de {{count($students) + count($failures)}}
            succesvol ingevoerd</h1>

        <div class="row">
            <div class="col s12">
                <ul class="tabs excel-tabs">
                    <li class="tab col s6"><a href="#test1">Succes ({{count($students)}})</a></li>
                    <li class="tab col s6"><a class="active" href="#test2">Errors ({{count($failures)}})</a></li>
                </ul>
            </div>
            <div id="test1" class="col s12">
                <table class="table-excel-log">
                    <thead>
                    <tr>
                        <th>Rij</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr class="tr-succes">
                            <td>{{$loop->index}}</td>
                            <td>{{$student->naam}}</td>
                            <td>{{$student->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="test2" class="col s12">
                <table class="table-excel-log">
                    <thead>
                    <tr>
                        <th>Rij</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Bericht</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($failures as $failure)
                        <tr>
                            <td>{{$loop->index}}</td>
                            <td @if(!$failure->naam) class="error" @endif>@if($failure->naam){{$failure->naam}}@else naam is leeg @endif</td>
                            <td @if(!$failure->email)class="error" @endif>@if($failure->email) {{$failure->email}}@else email is leeg @endif</td>
                            <td @if($failure->email)class="error" @endif><span class="error-color">{{$failure->err_message}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection