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
                    <div id="les_dons" class="flex">
                        @foreach (Auth::user()->participationdon as $parti)

                        <div class="parti_don" >
                            <h4><a href="/action?id={{ $parti->action->idaction }}">{{ $parti->action->titreaction }}</a></h4>
                            <p>Montant de la participation: {{$parti->montantdelaparticipation}}€</p>
                        </div>
                        @endforeach
                    </div>
                    <h3>Vos 3 dernières participations bénévoles:</h3>
                    <div id="les_dons" class="flex">
                        @foreach (Auth::user()->participationbenevole as $parti)

                        <div class="parti_don">
                            <h4><a href="/action?id={{ $parti->action->idaction }}">{{ $parti->action->titreaction }}</a></h4>
                            <p>Vous avez participé à cette action.</p>
                        </div>
                        
                        @endforeach
                    </div>

                    <h3>Vos 3 dernières action visionnées:</h3>
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
                @elseif (Auth::user()->dpo)
                    <h3>Type de compte: Directeur protection des données</h3>
                @else
                    <h3>Type de compte: Utilisateur</h3>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>