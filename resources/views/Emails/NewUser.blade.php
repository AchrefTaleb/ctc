@component('mail::message')
Bonjour {{ $name }},<br/>

Notre équipe a créé un compte pour vous, cliquez sur le bouton ci-dessous pour définir votre mot de passe

@component('mail::button', ['url' => $link])
    Définir votre mot de passe
@endcomponent


Nous sommes heureux que vous rejoigniez notre communauté<br/>

Merci,<br>
{{ config('app.name') }}
@endcomponent
