@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"> <h1 class="h2">Teachers</h1>  <a href="create">Create a new teacher</a></div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Owner of</th>
                <th>#</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{$teacher->name . " " .$teacher->prefix . " " . $teacher->lastname}}</td>
                <td>@if(count($teacher->studio))
                        {{$teacher->studio()->first()->name}}
                    @else
                        Relation is not set
                    @endif
                </td>
                <td><a href="/admin/teacher/edit/{{$teacher->id}}">edit</a></td>
                <td><a href="/admin/teacher/delete/{{$teacher->id}}">delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection