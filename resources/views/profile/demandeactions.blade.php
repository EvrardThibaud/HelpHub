@section('title', 'Demandes Action - HelpHub')

<x-app-layout>

    <div id="page">
        <h1>Demandes d'action</h1>
        <p>Ici vous pouvez traiter les demandes d'action.</p>
        <div id="content">

            <div id="lesactions">
                @if(count($actions) > 0)
                    @foreach ($actions as $action)
                    <div>
                        <div class="flex">
                            <form method="POST" action="{{ route('accepteraction', ['id' => $action->idaction]) }}">
                                @csrf
                                <button id="accepter" type="submit">Accepter</button>
                            </form>
                            <form method="POST" action="{{ route('refuseraction', ['id' => $action->idaction]) }}">
                                @csrf
                                <button id="refuser" type="submit">Refuser</button>
                            </form>
                        </div>
                        @include('includes.actioncard')
                    </div>
                    @endforeach
                @else
                    <h1>Aucune demande d'action.</h1>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>

<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        
        let actionStatus = "{{ session('action_status') }}";
        if (actionStatus === 'success_accepter') {

            console.log('L\'action a été acceptée.');

        }if (actionStatus === 'success_refuser') {

            console.log('L\'action a été refusée.');

        }
    });

</script>
