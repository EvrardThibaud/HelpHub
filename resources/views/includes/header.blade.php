<link rel="stylesheet" href="css/header.blade.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/adressecompletion.css">
<link rel="stylesheet" href="css/dashboard/app.blade.css">
<link rel="stylesheet" href="css/dashboard/mescoms.blade.css">
<link rel="stylesheet" href="css/dashboard/mesactions.blade.css">
<link rel="stylesheet" href="css/dashboard/demandeactions.blade.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="css/actioncard.blade.css">
<link rel="stylesheet" href="css/toast.css">

<script src="js/toast.js"></script>

<script src="https://kit.fontawesome.com/b0bb7a843e.js" crossorigin="anonymous"></script>
<header id="header">
    <a id="logo" href="/"><img src="img/logo.png" alt="logo de helphub"></a>
    <div class="header-right">

        @if (Route::has('login'))
            @auth
                <i id="notif" class="fa-solid fa-bell"></i>
                <!-- Page de notification -->
                <div id="notif_page" class="hiddenNotif">
                    <h3>Notifications</h3>
                    @if (Auth::user()->notification)
                        @if( count(Auth::user()->notifications)>0 )
                            @foreach (Auth::user()->notifications as $notif)
                                @if($notif->action)
                                    <div class="notif">
                                        <h4 class="notif_titre">Nouvelle action</h4>
                                        <p class="notif_date">{{$notif->datenotification}}</p>
                                        <p>{{ json_decode('"'.$notif->texte.'"') }}</p>
                                    </div>
                                @endif
                            @endforeach
                            <p>Vous n'avez aucune notification.</p>
                        @endif
                    @else
                        <p>Vous avez désactivé les notifications.</p>
                        <p>Voir <a href="{{ route('profile.preferences') }}">Mes Préférences</a> pour activer.</p>
                    @endif
                </div>
                <a class="lien" href="{{ url('/dashboard') }}"> Mon Compte</a>
        @else
                <a class="lien" href="{{ route('login') }}"> Identification</a>
                
                @if (Route::has('register'))
                <a class="lien" href="{{ route('choix-inscription') }}"> Inscription</a>
                @endif
            @endauth
        @endif
    </div>

</header>


<script src="js/header.blade.js" defer></script>
