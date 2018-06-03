@component('mail::message')
    # Inlog gegevens domeinnaam

    Beste {{$student->name}},

    Gegevens voor het inloggen op domeinnaam

    Email: {{$student->email}}
    Wachtwoord: {{$password}}

    Hartelijke groet,

    Team Sound Education
@endcomponent