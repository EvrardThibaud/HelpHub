<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/persocookies.blade.css">
    <title>Personnaliser vos Cookies</title>
</head>
<body>

    @include('includes.header')
    <h1>Personnaliser les cookies</h1>

    <main>
        <div class="container">
            <section id="cookie-preferences">
                <h2>Personnaliser les préférences sur les cookies</h2>
                <p>Nous utilisons des cookies et des outils similaires (collectivement appelés les « cookies ») aux fins décrites ci-dessous. Les tiers approuvés utilisent également des cookies à des fins limitées liées aux publicités décrites ci-dessous. Nous appliquerons vos préférences en matière de cookies sur le service Amazon (version du site web et de l'application) sur lequel vous vous êtes identifié. Si vous n'êtes pas connecté, nous devrons peut-être vous demander à nouveau vos préférences.</p>

                <div class="cookie-option">
                    <input type="checkbox" id="accept-all-cookies" checked>
                    <label for="accept-all-cookies">Accepter tous les cookies</label>
                </div>

                <div class="cookie-option">
                    <input type="checkbox" id="save-custom-preferences">
                    <label for="save-custom-preferences">Sauvegarder les préférences personnalisées</label>
                </div>

                <div class="cookie-category">
                    <h2>Cookies opérationnels</h2>
                    <p>Les cookies opérationnels ne peuvent pas être désactivés dans la mesure où nous les utilisons pour vous fournir nos services.</p>
                </div>

                <div class="cookie-category">
                    <h2>Cookies publicitaires</h2>
                    <p>Ces cookies nous permettent de vous proposer d'autres types de publicités (par exemple, pour des produits et services non disponibles sur Amazon), notamment des publicités correspondant à vos centres d'intérêt, et de collaborer avec des tiers approuvés dans le cadre du processus de diffusion de contenu, afin de mesurer l'efficacité des publicités et d'effectuer des services pour le compte d'Amazon.</p>

                    <p>Pour en savoir plus sur la façon dont Amazon présente des publicités basées sur les centres d’intérêt, consultez Publicités basées sur vos Centres d’Intérêt. Pour modifier vos préférences en matière de publicités basées vos centres d’intérêt, rendez-vous sur la page Préférences pour les publicités sur Amazon.</p>

                    <div class="customize-ad-options">
                        <div class="cookie-option">
                        <div class="toggle-switch">
                        <input type="checkbox" id="pubHelpHub-cookies" checked disabled>
                        <!-- Ajoutez une balise span pour personnaliser le style -->
                        <label for="operational-cookies"><span class="custom-checkbox"></span></label>
                    </div>
                            <label for="helphub-ads">Publicité HelpHub</label>
                        </div>

                        <div class="cookie-option">
                        <div class="toggle-switch">
                        <input type="checkbox" id="pubtiers-cookies" checked disabled>
                        <!-- Ajoutez une balise span pour personnaliser le style -->
                        <label for="operational-cookies"><span class="custom-checkbox"></span></label>
                    </div>
                            <label for="third-party-ads">Publicitaires tiers approuvés</label>
                        </div>
                    </div>

                    <button id="customize-ad-cookies">Personnaliser les cookies publicitaires</button>
                </div>
            </section>
        </div>
    </main>

    @include('includes.footer')

</body>
</html>
