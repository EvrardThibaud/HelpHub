@section('title', 'Mon Profil - HelpHub')

<x-app-layout>

    <div id="page">
        <div class="flex">

            <div id="leftsection">
                @if (Auth::user()->association)
                    <h1>Bienvenue {{Auth::user()->association->nomassociation}}</h1>
                    {{Auth::user()->association}}
                @elseif (Auth::user()->servicediffusion)
                @else
                    <h1>Bienvenue {{Auth::user()->prenomutilisateur}} {{Auth::user()->nomutilisateur}}</h1>
                @endif
        
        
            </div>
            <div id="rightsection">
                @if (Auth::user()->association)
                    <h3>Type de compte: Association</h3>
                @elseif (Auth::user()->servicediffusion)
                    <h3>Type de compte: Service Diffusion</h3>
                @else
                    <h3>Type de compte: Utilisateur</h3>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>