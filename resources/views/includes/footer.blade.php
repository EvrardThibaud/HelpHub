
<link rel="stylesheet" href="css/footer.blade.css">


<footer class="center" id="footer">
    <a id="logo" href="/">HelpHub</a>
    <div class="center">
        <p><a class="" href="{{ url('/cookies') }}">
                        {{ __('Cookies') }}
                    </a> <a class="" href="{{ url('/politique') }}">
                        {{ __('Politique de confidentialité') }}
                    </a></p>
        <p><a>Vos informations personnelles</a> <a class="" href="{{ url('/cgu') }}">
                        {{ __('Conditions générales d\'utilisation') }}
                    </a></p>
        <p><a class="" href="{{ url('/contact') }}">
                        {{ __('Données personnelles') }}
                    </a>
                    
                    <a class="" href="{{ url('/mentions') }}">
                        {{ __('Mentions légales') }}
                    </a>
                    <a class="" href="{{ url('/persocookies') }}">
                            {{ __('Personnaliser les cookies') }}
                        </a></p>
                    
        <p>&copy; 2023 Helphub - Tous droits réservés</p>
    </div>

        

</footer>