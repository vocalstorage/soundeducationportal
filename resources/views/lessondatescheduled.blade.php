@component('mail::message')
    # reservation confirmed

    Hi {{\Auth::user()->name}},

    Your {{$lessondate->lesson->title}} is confirmed

    {{date_format(new DateTime($lessondate->date),'l\, jS F \a\t '. $lessondate->time)}}

@component('mail::button', ['url' => ''])
    view your appointments
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
