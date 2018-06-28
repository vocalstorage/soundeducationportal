@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"><h1>{{trans('modules/teacher.title')}}</h1>  <a href="{{route('admin-teacher-create')}}">{{trans('modules/teacher.function.create')}}</a></div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>{{trans('form.label.title')}}</th>
                <th>{{trans('form.label.owner_of')}}</th>
                <th>{{trans('form.label.color')}}</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher->name}}</td>
                    <td>@if($teacher->studio)
                            {{$teacher->studio()->first()->name}}
                        @else
                            Heeft nog geen studio
                        @endif
                    </td>
                    <td>
                        <div class="color-box" style="background-color: {{$teacher->color}}"></div>
                    </td>
                    <td>
                        <a href="{{route('admin-teacher-edit', $teacher->id)}}"><i class="material-icons">edit</i></a>
                        <a href="{{route('admin-teacher-delete', $teacher->id)}}" class="swal-show-warning"
                           data-message="{{$teacher->warnings()}}"
                           data-loading-message="Deleting lesson">
                            <i class="material-icons">delete</i>
                        </a>                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection