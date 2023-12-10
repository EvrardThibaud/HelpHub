@section('title', 'Mes actions - HelpHub')

<x-app-layout>

    <div id="page">
        <h1>Mes actions</h1>
        <div id="content">

            <div id="ajouteraction">
                
                <a class="bt" id="" href="{{ route('profile.creeraction') }}" >Créer une action</a> 
            </div>
            <div id="mesactions">
                
                @if (count(Auth::user()->association->actions) > 0)
                    @foreach (Auth::user()->association->actions as $action)
                        <div>
                            <h4>Modifier Supprimer</h4>
                            @include('includes.actioncard')
                        </div>
                    @endforeach
                    
                @else
                <h1>Vous n'avez pas d'actions.</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
