<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement du formulaire et sauvegarde des préférences
    if (isset($_POST["savePreferences"])) {
        $preferences = [];
        if (isset($_POST["name"])) {
            $preferences[] = "Nom";
        }
        if (isset($_POST["firstName"])) {
            $preferences[] = "Prénom";
        }
        if (isset($_POST["phone"])) {
            $preferences[] = "N° de téléphone";
        }
        if (isset($_POST["email"])) {
            $preferences[] = "Email";
        }
        if (isset($_POST["address"])) {
            $preferences[] = "Adresse";
        }
        if (isset($_POST["gender"])) {
            $preferences[] = "Civilité";
        }

        $preferencesJson = json_encode($preferences);
        file_put_contents("preferences.json", $preferencesJson);
    }
}
?>

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

    <div class="cookie-settings">
        <h2>Paramètres de Confidentialité</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="privacy-settings">
                <label>
                    <input type="checkbox" id="acceptAll" checked>
                    Accepter tous les cookies
                </label>
                <label>
                    <input type="checkbox" id="savePreferences" name="savePreferences">
                    Choisir mes préférences
                </label>
                <div id="preferencesOptions">
                    <label><input type="checkbox" name="name"> Nom</label>
                    <label><input type="checkbox" name="firstName"> Prénom</label>
                    <label><input type="checkbox" name="phone"> N° de téléphone</label>
                    <label><input type="checkbox" name="email"> Email</label>
                    <label><input type="checkbox" name="address"> Adresse</label>
                    <label><input type="checkbox" name="gender"> Civilité</label>
                </div>
            </div>

            <div class="cookie-slide">
                <h3>Cookie Opérationnel</h3>
                <p>Les cookies opérationnels sont nécessaires au fonctionnement du site web. Vous ne pouvez pas les désactiver.</p>
            </div>

            <div class="cookie-settings">
                <h2>Cookies Publicitaires</h2>
                <label>
                    <input type="checkbox" id="advertisingHelpHub">
                    Accepter les publicités HelpHub
                </label>
                <label>
                    <input type="checkbox" id="thirdPartyAds" name="thirdPartyAds">
                    Choix publicitaires
                </label>
                <div id="thirdPartyOptions">
                    <!-- Remplacez les noms des publicités tiers ci-dessous -->
                    <label><input type="checkbox" name="ad1"> Publicité 1</label>
                    <label><input type="checkbox" name="ad2"> Publicité 2</label>
                    <label><input type="checkbox" name="ad3"> Publicité 3</label>
                    <label><input type="checkbox" name="ad4"> Publicité 4</label>
                    <label><input type="checkbox" name="ad5"> Publicité 5</label>
                </div>
            </div>

            <button href="welcome" >Sauvegarder</button>
        </form>
    </div>

    @include('includes.footer')

    <script src="js/persoCookie.blade.js"></script>
</body>
</html>
