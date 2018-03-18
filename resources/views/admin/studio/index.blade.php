@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;"> <h1 class="h2">Studios</h1>  <a href="create">Create new Studio</a></div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>Studio Name</th>
                <th>Description</th>
                <th>Place</th>
                <th>Street</th>
                <th>Postal code</th>
                <th>#</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($studios as $studio)
            <tr>
                <td>{{$studio->name}}</td>
                <td>{{$studio->description}}e</td>
                <td>{{$studio->place}}</td>
                <td>{{$studio->street}}</td>
                <td>{{$studio->postal_code}}</td>
                <td><a href="edit/{{$studio->id}}">Edit</a></td>
                <td><a href="delete/{{$studio->id}}">Delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection