<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.blade.css">
</head>

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