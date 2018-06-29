@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">{{trans('modules/schoolgroup.function.create')}}</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{route('admin-schoolgroup-store')}}"  method="post">
                {{csrf_field()}}
                <div class="file-field input-field col s12">
                    <a id="excelFilemanager" data-input="thumbnail" data-preview="holder">
                        <div class="btn  waves-effect">
                            <i class="material-icons white-text">file_upload</i>
                        </div>
                    </a>
                    <div class="file-path-wrapper">
                        <input id="thumbnail" class="validate {{ $errors->has('filepath') ? ' invalid' : '' }}" type="text" name="filepath" value="{{old('filepath') ? old('filepath') : ''}}">
                        <label for="thumbnail">Excel file</label>
                    @if ($errors->has('filepath'))
                            <span class="helper-text" data-error="{{ $errors->first('filepath') }}"></span>
                        @endif
                    </div>
                </div>
                <div class="input-field col s12">
                    <input id="schoolgroup" value="{{old('schoolgroup') ? old('schoolgroup') : ''}}" type="text"
                           class="validate {{ $errors->has('schoolgroup') ? ' invalid' : '' }}" name="schoolgroup">
                    <label for="schoolgroup">Klas naam</label>
                    @if ($errors->has('schoolgroup'))
                        <span class="helper-text" data-error="{{ $errors->first('schoolgroup') }}"></span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <button id="createSchoolgroup" type="submit" class="btn  waves-effect">{{trans('form.button.save')}}</button>
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
                    <li class="tab col s6"><a href="#succes">Succes ({{count($students)}})</a></li>
                    <li class="tab col s6"><a class="active red-text" href="#errors" >Errors ({{count($failures)}})</a></li>
                </ul>
            </div>
            <div id="succes" class="col s12">
                <table class="table-excel-log">
                    <thead>
                    <tr>
                        <th>{{trans('form.label.row')}}</th>
                        <th>{{trans('form.label.name')}}</th>
                        <th>{{trans('form.label.email')}}</th>
                        <th>{{trans('form.label.tel')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr class="tr-succes">
                            <td>{{$loop->index}}</td>
                            <td>{{$student->naam}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->tel}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="errors" class="col s12">
                <table class="table-excel-log">
                    <thead>
                    <tr>
                        <th>{{trans('form.label.row')}}</th>
                        <th>{{trans('form.label.name')}}</th>
                        <th>{{trans('form.label.email')}}</th>
                        <th>{{trans('form.label.tel')}}</th>
                        <th>{{trans('form.label.message')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($failures as $failure)
                        <tr>
                            <td>{{$loop->index}}</td>
                            <td @if(!$failure->name) class="red-text" @endif>@if($failure->name){{$failure->name}}@else naam is leeg @endif</td>
                            <td @if(!$failure->email)class="red-text" @endif>@if($failure->email) {{$failure->email}}@else email is leeg @endif</td>
                            <td @if(!$failure->tel)class="red-text" @endif>@if($failure->tel) {{$failure->tel}}@else telefoon nummer is leeg @endif</td>
                            <td @if($failure->email)class="red-text" @endif><span class="error-color">{{$failure->err_message}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection