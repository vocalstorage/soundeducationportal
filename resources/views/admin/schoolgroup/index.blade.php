@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
           <h1>Klassen</h1>
            <a href="{{route('admin-schoolgroup-create')}}">Create a new class</a>
        </div>
    </div>
    <ul class="collapsible  popout">
        @foreach($schoolgroups as $schoolgroup)
            <li>
                <div class="collapsible-header">
                    <div class="collap-header-title">
                        {{$schoolgroup->title}}
                    </div>
                    <div class="collap-header-functions">
                        <a href="{{route('admin-schoolgroup-edit', $schoolgroup->id)}}"><i class="material-icons">edit</i></a>
                        <a href="{{route('admin-schoolgroup-delete', $schoolgroup->id)}}" class="confirm_delete" data-message="Deleting student: {{$schoolgroup->name}}"><i class="material-icons">delete</i></a>
                    </div>
                </div>
                <div class="collapsible-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Cancels</th>
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
                                    <a href="{{route('admin-student-delete', $student->id)}}" class="confirm_delete" data-message="Deleting student: {{$student->name}}" ><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        @endforeach
    </ul>
@endsection