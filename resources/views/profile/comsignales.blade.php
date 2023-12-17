@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/comsignales.blade.css">

    <div id="page">
        <h1>Les signalements</h1>
        @if(session('message'))
            <script>
                var message = '{{ session('message') }}';
                createToast('valid', message)
            </script>
        @endif
        <div id="lescoms">
            @if (count($commentaires) > 0)
                @foreach ($commentaires as $commentaire)


                    <div class="commentaire">
                        <h4>Action: <a href="/action?id={{ $commentaire->commentaire->action->idaction }}">{{$commentaire->commentaire->action->titreaction}}</a></h4>
                        <div class="commentaire_user">
                            @if($commentaire->commentaire->image)
                                <img src="{{ $commentaire->image }}"  >
                            @else
                                <img src="https://cdn4.iconfinder.com/data/icons/basic-ui-pack-flat-s94-1/64/Basic_UI_Icon_Pack_-_Flat_user-512.png" >
                            @endif
                            <div class="column">
                                
                                <h3>
                                    
                                    @if ($commentaire->commentaire->utilisateur->admin)
                                        <span style="color: red;">Administrateur {{ $commentaire->commentaire->utilisateur->prenomutilisateur }} {{ $commentaire->commentaire->utilisateur->nomutilisateur }}</span>
                                    @else
                                        {{ $commentaire->commentaire->utilisateur->prenomutilisateur }} {{ $commentaire->commentaire->utilisateur->nomutilisateur }}
                                    @endif
                                </h3>
                                <p id="date_commentaire">{{ \Carbon\Carbon::parse($commentaire->commentaire->datecommentaire)->isoFormat('D MMMM Y', 'Do MMMM Y') }}</p>
                            </div>
                        </div>
                        <p>{{ $commentaire->commentaire->textecommentaire }}</p>   
                        <span class="espace"></span>               
                        <p>Par: {{$commentaire->utilisateur->prenomutilisateur}} {{$commentaire->utilisateur->nomutilisateur}}</p>
                        <p>Raison: {{$commentaire->contenusignalement}}</p>
                        <div id="btresult" class="flex">
                            <form method="POST" action="{{ route('profile.acceptersignalement', ['idcommentaire' => $commentaire->idcommentaire, 'idsignalement' => $commentaire->idsignalement]) }}">
                                @csrf
                                <button id="accepter" class="bouton" type="submit">Supprimer le commentaire</button>
                            </form>
                            <form method="POST" action="{{ route('profile.refusersignalement', ['idsignalement' => $commentaire->idsignalement]) }}">
                                @csrf
                                <button id="refuser" class="bouton" type="submit">Refuser le signalement</button>
                            </form>
                        </div>
                    </div>


                @endforeach
            @else
            <div class="center" style="height: 80vh;">

                <h1>Aucun signalement de commentaire.</h1>
            </div>
            @endif
        </div>
    </div>
    
</x-app-layout>