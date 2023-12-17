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
                    <h3>Vos 3 derniers dons:</h3>
                    {{Auth::user()->participationdon}}
                    <h3>Vos 3 dernières participations bénévoles:</h3>
                    {{Auth::user()->participationbenevole}}
                    <h3>Vos 3 dernières action regardées:</h3>
                    <div id="container_action" class="flex">
                        @if(Auth::user()->historiquevisu->count() > 0)
                            @foreach (Auth::user()->historiquevisu as $histo)
                                @php $action = $histo->actions @endphp
                                @include('includes.actioncard')
                            @endforeach
                        @else
                            <p>Aucune action visionnée.</p>
                        @endif
                    </div>
                @endif
        
        
            </div>
            <div id="rightsection">
                @if (Auth::user()->association)
                    <h3>Type de compte: Association @if(Auth::user()->directeurasso) (Directeur)@endif</h3>
                @elseif (Auth::user()->servicediffusion)
                    <h3>Type de compte: Service Diffusion</h3>
                @else
                    <h3>Type de compte: Utilisateur</h3>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>