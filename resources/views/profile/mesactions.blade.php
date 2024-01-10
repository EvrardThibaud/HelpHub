@section('title', 'Mes actions - HelpHub')
<head>
<meta name="delete-url" content="{{ route('profile.supprimeraction', ['id' => '']) }}">
</head>
<x-app-layout>

    <div id="page">
        @if(session('message'))
            <script>
                var message = '{{ session('message') }}';
                createToast('valid', message)
            </script>
        @endif
        <h1>Mes actions</h1>
        <div id="content">

            <div id="ajouteraction">
                
                <a class="bt" id="" href="{{ route('profile.creeraction') }}" >Créer une action</a> 
            </div>
            <div id="mesactions">
                @if (count(Auth::user()->association->actions) > 0)
                    @foreach (Auth::user()->association->actions as $action)
                        <div>
    
                            @if (!($action->valideparservice))
                                <h4 id="pasvalidetexte">L'action n'a pas encore été validée.</h4>
                            @else
                                <div id="modifier_ou_supprimer" class="flex">
                                    <form method="GET" action="{{route('profile.modifaction')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$action->idaction}}">
                                        <button id="modifier" type="submit">Modifier</button>
                                    </form>
                                    <form method="GET" action="{{route('profile.ajoutimage')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$action->idaction}}">
                                        <button id="ajouter" type="submit">Ajouter image</button>
                                    </form>
                                    
                                    <button id="supprimer" data-action="{{ $action }}" type="text">Supprimer</button>
                                    
                                </div>
                            @endif
                            <div class="
                            {{ !$action->valideparservice ? 'pasvalide' : '' }}
                            ">
                            
                            @include('includes.actioncard')
                        </div>
                    </div>
                    @endforeach
                    
                @else
                <h1>Vous n'avez pas d'actions.</h1>
                @endif
            </div>
        </div>
    </div>

    <div id="confirmation" class="hide">
        <div id="c">

            <div id="confirmation_content">
                <h1>Etes vous sûr de vouloir supprimer l'action ?</h1>
                <h2 id="letitre"></h1>
                <div id="bt">
                    <div class="flex">
                        <form method="POST" id="formsupr" action="{{ route('profile.supprimeraction') }}">
                            @csrf
                            <input type="text" style="display: none" name="idaction" id="idaction">
                            <button class="bouton" type="submit">Accepter</button>
                        </form>
                        <p class="bouton" id="annuler" >Annuler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="js/mesactions.blade.js" defer></script>

