@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"> <h1 class="h2">students</h1> </div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>#</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>
                <td><a href="/admin/student/delete/{{$student->id}}">delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection