<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.blade.css">
</head>

<footer class="center" id="footer">
    <a id="logo" href="/">HelpHub</a>
    <div class="center">
        <p><a class="" href="{{ route('cookies') }}">
                        {{ __('Cookies') }}
                    </a> <a class="" href="{{ route('politique') }}">
                        {{ __('Politique de confidentialité') }}
                    </a></p>
        <p><a>Vos informations personnelles</a> <a class="" href="{{ route('cgu') }}">
                        {{ __('Conditions générales d\'utilisation') }}
                    </a></p>
        <p><a class="" href="{{ route('contact') }}">
                        {{ __('Données personnelles') }}
                    </a>
                    
                    <a class="" href="{{ route('mentions') }}">
                        {{ __('Mentions légales') }}
                    </a>
                    <a class="" href="{{ route('persocookies') }}">
                            {{ __('Personnaliser les cookies') }}
                        </a></p>
                    
        <p>&copy; 2023 Helphub - Tous droits réservés</p>
    </div>

        

</footer>