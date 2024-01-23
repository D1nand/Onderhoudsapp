@component('mail::message')
# Stel je wachtwoord in

Om je wachtwoord in te stellen, klik je op de onderstaande knop.

@component('mail::button', ['url' => $passwordCode])
Wachtwoord instellen
@endcomponent

Bedankt,<br>
Onderhoudsapp
@endcomponent
