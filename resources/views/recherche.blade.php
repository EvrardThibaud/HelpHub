<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/recherche.blade.css">
    <title>Recherche - HelpHub</title>
</head>
<body>
    @include('includes.header')
    <main>
        @include('includes.recherche')


        <!-- Résultats -->
        <div >
            <ul id="ul_info_resultat_recherche">
                <h4>{{ count($actions) }} réultats pour les filtres suivants :</h4>
                <li> <b>Thématique:</b>  {{ $thematique_choisie->libellethematique }}</li>
                <li> <b>Association:</b>  {{$association_choisie->nomassociation}}</li>
                <li> <b>Date:</b>  {{$filtrage->date}}</li>
                <li> <b>Code postal / Ville:</b>  {{$filtrage->localisation}}</li>
                <li> <b>Mots clés:</b>  {{$filtrage->motscles}}</li>

                

            </ul>

            <ul id="ul_resultat_recherche">
                @foreach ($actions as $action)

                    <!-- Affichage des cartes des actions -->
                    @include('includes.actioncard')
                @endforeach
            </ul>
        </div>
    </main>
    @include('includes.footer')
</body>
</html>