@extends('teacher.layouts.master')
@section('content')
        <h1 class="h2">Afspraken voor vandaag</h1>
        <ul class="collapsible">
        @foreach($lessonDates as $lessonDate)
                <li>
                    <div class="collapsible-header"><i class="material-icons">music_note</i>{{$lessonDate->lesson->title}} - {{$lessonDate->time}}</div>
                    <div class="collapsible-body">
                        <table>
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Tel</th>
                            </tr>
                            </thead>

                        <tbody>
                        @foreach($lessonDate->lessonDateRegistrations as $registration)
                            <tr>
                                <td>{{$registration->student->name}} </td>
                                <td>{{$registration->student->email}}</td>
                                <td>$0.87</td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </li>
        @endforeach
        </ul>
@endsection