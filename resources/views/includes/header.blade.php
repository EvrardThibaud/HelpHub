<link rel="stylesheet" href="css/header.blade.css">
<link rel="stylesheet" href="css/style.css">
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