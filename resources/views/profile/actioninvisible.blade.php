@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>

    <div id="page">
        <div id="mesactions">
            @if (count($actions) > 0)
                @foreach ($actions as $action)
                    <div>

                        @if (!($action->visible))
                            <h4 id="pasvalidetexte">L'action est invisible.</h4>
                            <div class="input_div">
                                <form action="{{ route('action.invisible') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                                    <button id="submit_button" type="submit">Rendre visible</button>
                                </form>

                            </div>
                        @else
                            <div class="input_div">
                                <form action="{{ route('action.visible') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                                    <button type="submit" id="submit_button">Rendre invisible</button>
                                </form>
                            </div>
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