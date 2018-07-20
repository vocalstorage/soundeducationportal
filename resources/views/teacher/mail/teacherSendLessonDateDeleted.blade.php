@component('mail::message')
# Beste {{$teacher->name}},

De les {{$lessonDate->lesson->title}} op {{$lessonDate->date->format('d/m/Y')}} om {{$lessonDate->time}} is komen te vervallen.
Deze kun je dus uit je agenda verwijderen.

Mocht je vragen hebben over de planning, dan kun je terecht bij
<a href="mailto:planning@soundeducation.nl">planning@soundeducation.nl</a>

Hartelijke groet,

Ignace Dhont <br>
Sound Education
@endcomponent