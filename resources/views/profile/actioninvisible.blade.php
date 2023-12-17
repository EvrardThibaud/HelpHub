@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>

    <div id="page">
        <div id="mesactions">
            @if (count($actions) > 0)
                @foreach ($actions as $action)
                    <div>

                        @if (!($action->visible))
                            <h4 id="pasvalidetexte">L'action est invisible.</h4>
                            <form action="{{ route('action.invisible') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                                <button type="submit">Rendre visible</button>
                            </form>
                        @else
                            <form action="{{ route('action.visible') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                                <button type="submit">Rendre invisible</button>
                            </form>
                        @endif
                        <div class="{{ !$action->visible ? 'pasvalide' : '' }}">
                        
                        @include('includes.actioncard')
                        </div>
                    </div>
                @endforeach
                
            @else
                <h1>Il n'y a pas d'actions.</h1>
            @endif
        </div>
    </div>
    
</x-app-layout>