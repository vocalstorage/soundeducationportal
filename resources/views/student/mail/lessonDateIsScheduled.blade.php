@component('mail::message')
# Beste {{\Auth::user()->name}},

Je praktijkles {{$lessondate->lesson->title}} op {{$lessondate->date->formatLocalized('%A %d %B')}} {{$lessondate->time}} is hierbij bevestigd.<br>
Zonder tegenbericht verwachten we je dus op dit tijdstip.

Het is tot 1 week voor aanvang mogelijk om je les te verplaatsen, dit kun je zelf doen door in te loggen, jouw naam te verwijderen van die datum en opnieuw in te plannen in een beschikbaar tijdslot.

Mocht je vragen hebben over de planning, dan kun je terecht bij
<a href="mailto:planning@soundeducation.nl">planning@soundeducation.nl</a>

Hartelijke groet,

Ignace Dhont <br>
Sound Education
@endcomponent
