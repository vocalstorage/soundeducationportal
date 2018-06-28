@component('mail::message')

    <h1>Beste {{$teacher->name}},</h1>

    De les {{$lessonDate->lesson->title}} op {{$lessonDate->date->formatLocalized('%A %d %B')}} om {{$lessonDate->time}} is komen te vervallen.

    Hartelijke groet,

    Team Sound Education
@endcomponent