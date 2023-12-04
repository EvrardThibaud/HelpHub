@section('title', 'Mes Commentaires - HelpHub')

<x-app-layout>

    <div id="page">
        @if(count($commentaires) > 0)
            <ul >
                @foreach ($commentaires as $com) 
                <li>
                    <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <li>id: {{ $com->idcommentaire}}</li>
                        <li>action: {{ $com->titreaction}}</li>
                        <li>texte: {{ $com->textecommentaire}}</li>
                        <li>nb like: {{ $com->nblikecommentaire}}</li>
                    </ul>
                </li>
                @endforeach
            </ul>
        @else
            <p>Aucun commentaires.</p>
        @endif
    </div>
</x-app-layout>