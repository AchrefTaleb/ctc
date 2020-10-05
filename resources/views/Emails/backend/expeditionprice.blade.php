@component('mail::message')
Cher(e) client(e) {{ $user->name.' '.$user->last_name }},

Nous vous informons que le coût pour votre demande de réexpédition n° {{ $request->id }} a été calculé par notre équipe pour un montant de {{ $request->price }} € au meilleur tarif en vigueur.
Connectez vous sur votre espace client rubrique “mon courrier - réexpédition” pour valider en procédant au paiement.
Votre demande de réexpédition sera alors prise en compte et validée.
Vous recevrez un mail dès l’envoi de celle ci par nos soins.


Merci de votre confiance.
L'équipe transfert de courrier

@endcomponent
