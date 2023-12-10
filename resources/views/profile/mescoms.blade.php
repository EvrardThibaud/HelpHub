@section('title', 'Mes Commentaires - HelpHub')

<x-app-layout>

    <div id="page">
        @if(count($commentaires) > 0)
            <ul>
                @foreach ($commentaires as $com)
                    <li>
                        <ul id="comment" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <!-- <li id="comment">id: {{ $com->idcommentaire}}</li> -->
                            <li id="action"><strong>Nom action :</strong> {{ $com->titreaction}}</li>
                            <li id="texte"><strong>Mon commentaire : </strong>{{ $com->textecommentaire}}</li>
                            <li id="nblike"><i class="fa-heart fa-regular"></i> {{ $com->nblikecommentaire}}</li>
                            <li>
                            <a href="{{ route('action.show', ['id' => $com->idaction]) }}">
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
            <p>Aucun commentaires.</p>
        @endif
    </div>
</x-app-layout>
