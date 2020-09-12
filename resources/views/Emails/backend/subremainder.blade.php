@component('mail::message')
Cher(e) client(e), {{ $user->name.' '.$user->last_name }},

Votre abonnement arrive à échéance dans {{ $days }} jours, il sera automatiquement renouvelé, veuillez verifier la validité de votre carte bancaire utilisé lors de l'inscription.
Pour se désinscrire merci de contacter notres services client:

                    Email : contact@transfertdecourrier.com

                    Tel : +33 1 42 39 30 78

Merci pour votre confiance,<br>
L’équipe transfert de courrier.

@endcomponent
