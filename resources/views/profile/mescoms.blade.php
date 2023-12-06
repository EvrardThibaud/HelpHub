@section('title', 'Mes Commentaires - HelpHub')

<x-app-layout>

    <div id="page">
        @if(count($commentaires) > 0)
            <ul >
                @foreach ($commentaires as $com) 
                <li>
                    <ul id="comment" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <li id="comment">id: {{ $com->idcommentaire}}</li> -->
                        <li id="action">action: {{ $com->titreaction}}</li>
                        <li id="texte">texte: {{ $com->textecommentaire}}</li>
                        <li id="nblike">nb like: {{ $com->nblikecommentaire}}</li>
                        <button  href="">Consulter la page</button>
                    </ul>
                    
                </li>
                @endforeach
            </ul>
        @else
            <p>Aucun commentaires.</p>
        @endif

        
    </div>
</x-app-layout>