@component('mail::message')
    # Inlog gegevens domeinnaam

    Beste {{$teacher->name}},

    Bij deze de gevens voor het inloggen op domeinnaam


    Email: {{$teacher->email}}
    Wachtwoord: {{$password}}

    Hartelijke groet,

    Team Sound Education
@endcomponent