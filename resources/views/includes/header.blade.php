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
        <a href="{{ url('/dashboard') }}"> Mon Compte</a>
        @else
        <a href="{{ route('login') }}"> Identification</a>
        
        @if (Route::has('register'))
        <a href="{{ route('choix-inscription') }}"> Inscription</a>
        @endif
        @endauth
        @endif
    </div>

</header>