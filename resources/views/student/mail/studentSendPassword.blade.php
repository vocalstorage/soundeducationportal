@component('mail::message')
# Beste {{$student->name}},

Bij deze de toegangsgegevens voor het inloggen op <a href="www.soundeducationplanner.nl">soundeducationplanner.nl</a>.<br>
Hier kun je het tijdstip (en soms ook de locatie) van jouw praktijklessen kiezen,
op het moment dat je hiertoe een uitnodiging per email voor krijgt.

<strong>Email:</strong> {{$student->email}} <br>
<strong>Wachtwoord:</strong> {{$password}}

Mocht je vragen hebben over de planning, dan kun je terecht bij
<a href="mailto:planning@soundeducation.nl">planning@soundeducation.nl</a>

Hartelijke groet,

Ignace Dhont <br>
Sound Education
@endcomponent