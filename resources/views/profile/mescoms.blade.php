@section('title', 'Mes Commentaires - HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/mescoms.blade.css">
<link rel="stylesheet" href="css/style.css">
    <div id="page">
        @if(count($commentaires) > 0)
        <h1>Mes commentaires</h1>
                <div id="comments_div">
                    
                    @foreach ($commentaires as $com)
                    <div id="comment" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <!-- <li id="comment">id: {{ $com->idcommentaire}}</li> -->
                            <p id="action_name">{{ $com->titreaction}}</p>
                            <strong>Mon commentaire : </strong>
                            <p id="texte">"{{ $com->textecommentaire}}"</p>
                            <p id="nblike">{{ $com->nblikecommentaire !== null ? $com->nblikecommentaire : 0 }} like(s)</p>

                            
                            <a href="{{ route('action.show', ['id' => $com->idaction]) }}">
                                    Consulter l'action
                            </a>
                        </div>
                        @endforeach
                </div>
            
        @else
            <p>Aucun commentaires.</p>
        @endif
    </div>
</x-app-layout>
