@component('mail::message')
Bienvenu(e) !

C’est avec grand plaisir que nous te souhaitons la bienvenue au sein de notre équipe.
Ci-dessous tu trouveras tes identifiants afin de te connecter dans l’espace administrateur :
Identifiant : {{ $user->email }}
Lien : <a href="{{ route('password.request') }}" target="_blank"> Connceter et changer votre mots de passe </a>
Nous te conseillons de le noter quelque part.
A très vite dans nos locaux,


L’équipe transfert de courrier

@endcomponent
