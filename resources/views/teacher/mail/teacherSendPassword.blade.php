@component('mail::message')
# Beste {{$teacher->name}},

Bij deze de toegangsgegevens voor het inloggen op <a href="www.soundeducationplanner.nl">soundeducationplanner.nl</a>.

<strong>Email:</strong> {{$teacher->email}} <br>
<strong>Wachtwoord:</strong> {{$password}}

Mocht je vragen hebben over de planning, dan kun je terecht bij
<a href="mailto:planning@soundeducation.nl">planning@soundeducation.nl</a>

Hartelijke groet,

Ignace Dhont <br>
Sound Education
@endcomponent