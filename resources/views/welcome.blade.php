<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accueil - HelpHub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/welcome.blade.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        
    </head>
    <body class="antialiased">


        @include('includes.header')
        <div id="cookie-consent-modal" class="cookie-consent-modal hidden"> 
                    <div class="content">
                            <h1 class="titre1">Les Cookies</h1>
                                <h2 class="titre2">
                                    Choisir vos préférences en matières de cookies
                                </h2>
                                <p class="titre3">
                                    Les <a href="cookies"> cookies</a>, matérialisés sous la forme d’un petit fichier texte au format alphanumérique, se définissent comme des traceurs déposés dans le terminal (ordinateur, tablette, smartphone) de l’internaute lorsqu’il consulte une page web, une application ou encore utilise un logiciel.
                                    Un cookie a une durée de validité limitée. Son dépôt et son stockage sur votre machine se font dans le respect de la législation en vigueur. Vous pouvez modifier vos préférences liées aux cookies à tout moment.
                                </p>
                                <p>
                                    Si vous acceptez, nous utiliserons également des cookies complémentaires à votre expérience d'achat dans les
                        boutiques Helphub. Cela inclut l'utilisation de cookies internes et tiers qui stockent ou accèdent aux informations standard de l'appareil tel qu'un identifiant unique. Les tiers utilisent des cookies dans le but d'afficher et de mesurer des publicités personnalisées, générer des informations sur l'audience, et développer et améliorer des produits. Cliquez sur «Personnaliser les cookies» pour refuser ces cookies, faire des choix plus détaillés ou en savoir plus. Vous pouvez modifier vos choix à tout moment en accédant aux Préférences pour les publicités sur Helphub, comme décrit dans l'Avis sur les cookies. Pour en savoir plus sur comment et à quelles fins Helphub utilise les informations personnelles (tel que l'historique des actions bénévoles), consultez notre <a href="politique" >Politique de confidentialité</a>.
                                </p>
                        <div class="btns">
                            <a href="persocookies" class="custom-link">  Personnaliser les cookies</a>
                            <button class="btn cancel" onclick="hideCookieModal()"><i class="fa-solid fa-xmark"></i> | Refuser</button>
                            <button class="btn accept" onclick="acceptCookies()"><i class="fa-solid fa-check"></i> | Accepter</button>
                        </div>

                        
                    </div>

        </div>

        
            
            <main>
                @include('includes.recherche')
                <div id="div_three_last_action">
                    <h2>Les 3 dernières actions</h2>
                    <ul id="list_three_last_action">
                    @foreach ($actions as $action)
                        @include('includes.actioncard')
                    @endforeach
                    </ul>
                </div>

            </main>
            
            @include('includes.footer')

            <script src="js/cookie.blade.js" defer></script>
    </body>
</html>
<script>
    var botmanWidget = {
        aboutText: '',
        introMessage: "Bienvenue dans notre site web"
    };
</script>
   
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
