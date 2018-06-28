@extends('admin.layouts.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="row">
            <div class="col-lg-12">
                <div style="float:left;">
                    <h1 class="h2">{{trans('modules/studio.title')}}</h1>
                    @if($teacherStudioNoRelations > 0)
                    <a href="{{route('admin-studio-create')}}">{{trans('modules/studio.function.create')}}</a>
                    @else
                        <a href="{{route('admin-teacher-create')}}" class="tooltipped" data-position="bottom" data-tooltip="Please create a teacher first (click link to create)">{{trans('modules/studio.function.create')}} (DISABLED)</a>
                    @endif
                </div>

            </div>
        </div>
        <table class="table table-striped" style="margin-top: 2%">
            <thead>
            <tr>
                <th>{{trans('form.label.title')}}</th>
                <th>{{trans('form.label.place')}}</th>
                <th>{{trans('form.label.street')}}</th>
                <th>{{trans('form.label.zipcode')}}</th>
                <th>{{trans('form.label.owner')}}</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($studios as $studio)
                <tr>
                    <td>{{$studio->name}}</td>
                    <td>{{$studio->place}}</td>
                    <td>{{$studio->street}} {{$studio->number}}</td>
                    <td>{{$studio->postal_code}}</td>
                    @if($studio->teacher)
                        <td><span style="color: {{$studio->teacher->color}}">{{$studio->teacher->name}}</span></td>
                    @else
                        <td>Eigenaar niet gevonden</td>
                    @endif
                    <td>
                        <a href="{{route('admin-studio-edit', $studio->id)}}"><i class="material-icons">edit</i></a>
                        <a href="{{route('admin-studio-delete', $studio->id)}}" class="swal-show-warning"
                           data-message="{{$studio->warnings()}}"
                           data-loading-message="Deleting studio">
                            <i class="material-icons">delete</i>
                        </a>                               </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection