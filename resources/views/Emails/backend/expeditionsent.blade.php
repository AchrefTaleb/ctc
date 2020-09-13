@component('mail::message')
Cher(e) client(e) {{ $user->name.' '.$user->last_name }},

Nous avons le plaisir de vous confirmer votre demande de réexpédition numéro {{ $request->id }} à l’adresse suivante <strong>{{ $request->adresse }}</strong>
Celle ci à été expédié.



Merci de votre confiance.
L'équipe transfert de courrier

@endcomponent
