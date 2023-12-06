@section('title', 'Mon Profil - HelpHub')

<x-app-layout>

    <div id="page">
        <div class="flex">

            <div id="leftsection">
                <h1>Bienvenue {{Auth::user()->prenomutilisateur}} {{Auth::user()->nomutilisateur}}</h1>
                <div>
                    <h2>Les actions que vous aimez</h2>
                    <div>Aucune</div>
                </div>
            </div>
            <div id="rightsection">
                <p>

                    {{Auth::user()}}
                    {{Auth::user()->adresse}}
                </p>
                {{Auth::user()->actionLike}}
            </div>
            
        </div>
    </div>
</x-app-layout>