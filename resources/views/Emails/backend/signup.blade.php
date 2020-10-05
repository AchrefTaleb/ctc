@component('mail::message')
Cher(e) client(e) {{ $user->name.' '.$user->last_name }},

Nous vous remercions de nous avoir fait confiance en choisissant le centre de transfert de courrier.
Votre inscription a bien été prise en compte, elle sera validée dès réception de votre paiement bancaire.
Vous pourrez alors vous connecter sur votre espace client via notre site avec le mot de passe que vous avez choisi et l’identifiant ci dessous:

Votre identifiant : {{ $user->email }}

@component('mail::button', ['url' => config('app.APP_URL')])
Connectez-vous
@endcomponent

Vous pouvez également à tout moment modifier votre mot de passe en vous connectant dans votre espace client dans la rubrique: “paramètre - profil”.

Merci de votre confiance.
L’équipe transfert de courrier

@endcomponent
