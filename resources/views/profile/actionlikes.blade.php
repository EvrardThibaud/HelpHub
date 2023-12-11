@section('title', 'Actions Likées- HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/actionlikes.blade.css">
    <div id="page">
        @if(count($likedActions) > 0)
            <ul>
                @foreach ($likedActions as $action)
                    <li>
                        <ul id="liked-action" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <li id="action-title"><strong>Nom action :</strong> {{ $action->titreaction }}</li>
                            <li id="association-likes"> <strong>Nom de l'association :</strong> {{ $action->nomassociation }}</li>
                            <li>
                                <a href="{{ route('action.show', ['id' => $action->idaction]) }}">
                                    <button>
                                        Consulter l'action
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune action likées</p>
        @endif
    </div>
</x-app-layout>