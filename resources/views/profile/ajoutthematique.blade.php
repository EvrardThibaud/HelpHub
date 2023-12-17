@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/comsignales.blade.css">

    <div id="page">
        
        <h1>Les Thématiques déjà enregistrées</h1>
        @foreach ($thematiques as $thematique)
            <p>{{ $thematique->libellethematique }}</p>
        @endforeach

        <h1>Ajouter une thématique</h1>

        <form id="form_creationthematique" method="POST" action="{{ route('creerThematique') }}">
            @csrf
        
                <div id="form_input">
                    <!-- Titre ACtion -->
                    <div class="input_div">
                        <x-input-label for="libellethematique" :value="__('Nom de la thématique:')" />
                        <x-text-input id="libellethematique" class="" type="text" name="libellethematique" :value="old('libellethematique')" required autofocus autocomplete="libellethematique"/>
                        <x-input-error :messages="$errors->get('libellethematique')" class="alert" />
                    </div>
            
            
                <div id="form_over">
                    <div id="form_login_submit">
                        <x-primary-button id="submit_button">
                            {{ __('Créer') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    
</x-app-layout>