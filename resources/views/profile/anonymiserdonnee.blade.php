@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>

    <div id="page">
        
        <h1>Anonymiser les données utilisateurs</h1>
        <p>Dans le cadre de mesures de sécurité, veuillez indiquer une date. Les comptes ayant été connectés avant cette date seront supprimés pour assurer la sécurité des utilisateurs.</p>
        <br/>
        <form id="anonymiserdonneeform" method="POST" action="{{ route('anonymiserdonneeform') }}">
            @csrf
            
            @if(isset($nbsuppression))

                <p>{{$nbsuppression}} utilsiateur(s) supprimé(s)</p>
            @endif

            <div class="input_div">
                <label for="date">Date limite :</label>
                <input type="date" id="date" name="date" required>
                <x-input-error :messages="$errors->get('date')" class="alert" />
            </div>
                
            
            <div id="form_over">
                <div id="form_login_submit">
                    <x-primary-button id="submit_button">
                        {{ __('Supprimer') }}
                    </x-primary-button>
                </div>
            </div>
         </form>

    </div>
    
</x-app-layout>