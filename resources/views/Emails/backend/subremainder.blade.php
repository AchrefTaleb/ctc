@component('mail::message')
Bonjour {{ $user->name.' '.$user->last_name }},

Remainder text.... //--> days left -> {{ $days }}

@component('mail::button', ['url' => config('app.APP_URL')])

@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent