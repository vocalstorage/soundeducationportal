@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col s12">
            <div style="float:left;"><h1 class="h2">Students</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="table table-striped" style="margin-top: 2%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>
                            <a href="{{route('admin-student-delete',$student->id)}}" class="confirm_delete">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection