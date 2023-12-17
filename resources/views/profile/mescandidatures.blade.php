@section('title', 'Mes Commentaires - HelpHub')

<x-app-layout>
    <link rel="stylesheet" href="css/dashboard/mescandidatures.css">
    <div id="page">
        <h1>Mes candidatures en cours</h1>
        <p>Ici vous pouvez consulter l'avancement de vos canditatures.</p>
        @if(count($candidatures) > 0)
            <div id="candidatures_div">
                @foreach ($candidatures as $candidature)
                    <div id="candidature" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <li id="idCandidature"><strong>Id candidature :</strong> {{ $candidature->idcandidature}}</li> -->
                        <p id="action_name">{{ $candidature->action->titreaction}}</p>
                        <strong>Etat candidature :</strong>
                        <p id="etatCandidature"> {{$candidature->etatCandidature->libelleetatcandidature }}<p>
                        <strong>Votre motivation :</strong>
                        <p id="nomAction">"{{ $candidature->informationscandidature}}"</p>
                        
                        <a href="{{ route('action.show', ['id' => $candidature->idaction]) }}">
                                Consulter l'action
                        </a>
                        </div>
                @endforeach
            </div>
        @else
            <p>Vous n'avez aucune demande de candidature en cours</p>
        @endif
    </div>
</x-app-layout>
