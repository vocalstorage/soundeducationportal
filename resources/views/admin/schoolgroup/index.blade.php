@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
           <h1>{{trans('modules/schoolgroup.title')}}</h1>
            <a href="{{route('admin-schoolgroup-create')}}">{{trans('modules/schoolgroup.function.create')}}</a>
        </div>
    </div>
    <ul class="collapsible  popout">
        @foreach($schoolgroups as $schoolgroup)
            <li>
                <div class="collapsible-header">
                    <div class="collapse-header-title">
                        {{$schoolgroup->title}}
                    </div>
                    <div class="collapse-header-functions">
                        <a href="{{route('admin-schoolgroup-edit', $schoolgroup->id)}}"><i class="material-icons">edit</i></a>
                        <a href="{{route('admin-schoolgroup-delete',$schoolgroup->id)}}" class="swal-show-warning"
                           data-message="{{$schoolgroup->warnings()}}"
                           data-loading-message="Deleting lesson">
                            <i class="material-icons">delete</i>
                        </a>                    </div>
                </div>
                <div class="collapsible-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{trans('form.label.title')}}</th>
                            <th>{{trans('form.label.email')}}</th>
                            <th>{{trans('form.label.cancels')}}</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schoolgroup->students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->cancels()}}</td>
                                <td>
                                    <a href="{{route('admin-student-delete',$student->id)}}" class="swal-show-warning"
                                       data-message="{{$student->warnings()}}"
                                       data-loading-message="Deleting lesson">
                                        <i class="material-icons">delete</i>
                                    </a>                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        @endforeach
    </ul>
@endsection