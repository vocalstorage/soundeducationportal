@component('mail::message')
    # reservation confirmed

    Hi {{\Auth::user()->name}},

    Your {{$lessondate->lesson->title}} is confirmed

    {{$lessondate->date->formatLocalized('%A %d %B')}} om {{$lessondate->time}}


@endcomponent
