@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;">
                    <h1 class="h2">Studios</h1>
                    @if($teacherStudioNoRelations > 0)
                    <a href="{{route('admin-studio-create')}}">Create new Studio</a>
                    @else
                        <a href="{{route('admin-teacher-create')}}" class="tooltipped" data-position="bottom" data-tooltip="Please create a teacher first (click link to create)">Create a studio (DISABLED)</a>
                    @endif
                </div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>Studio Name</th>
                <th>Place</th>
                <th>Street</th>
                <th>Postal code</th>
                <th>Owner</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($studios as $studio)
                <tr>
                    <td>{{$studio->name}}</td>
                    <td>{{$studio->place}}</td>
                    <td>{{$studio->street}}</td>
                    <td>{{$studio->postal_code}}</td>
                    @if($studio->teacher)
                        <td><span style="color: {{$studio->teacher->color}}">{{$studio->teacher->name}}</span></td>
                    @else
                        <td>Owner not found</td>
                    @endif
                    <td>
                        <a href="{{route('admin-studio-edit', $studio->id)}}"><i class="material-icons">edit</i></a>
                        <a href="{{route('admin-studio-delete', $studio->id)}}" class="confirm_delete" data-message="Deleting studio:{{$studio->name}}"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection