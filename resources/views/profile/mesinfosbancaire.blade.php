@section('title', 'Mes Infos Bancaires - HelpHub')

<x-app-layout>
    <link rel="stylesheet" href="css/dashboard/mesinfosbancaire.css">
    <link rel="stylesheet" href="css/style.css">
    <div id="page">
        @if(session('message'))
        <div class="message">
            {{ session('message') }}
        </div>
        @endif
        <div id="identite_bancaire_div">
            <h1>Mon identité bancaire</h1>
            @if(count($identite_bancaire) > 0)
                    @foreach ($identite_bancaire as $info)
                    <div>
                        
                        <form id="form_identite_bancaire" action="{{ route('updateinfosbancaire') }}" method="post">
                        @csrf
                            <div class="input_div">
                                <label for="numerocompte">Votre numéro de compte</label>
                                <input name="numerocompte" type="text" value="{{ $info->numerocompte }}" placeholder="Votre numéro de compte">
                                <x-input-error :messages="$errors->get('numerocompte')" class="alert" />
                            </div>
                                
                            <div class="input_div">
                                <label for="nomcompte">Le nom de votre compte</label>
                                <input name="nomcompte" type="text" value="{{ $info->nomcompte }}" placeholder="Le nom de votre compte">
                                <x-input-error :messages="$errors->get('nomcompte')" class="alert" />
                            </div>

                            <input id="submit_button" type="submit" value="Enregistrer mes infos bancaire">
                        </form>

                        <form action="{{ route('suppinfosbancaire') }}" method="post">
                        @csrf
                            <input class="sumbit_delete_button" id="submit_button" type="submit" value="Supprimer mes information bancaire">
                        </form>
                    </div>
                    @endforeach
            @else
                    <form id="form_identite_bancaire" action="{{ route('addinfosbancaire') }}" method="post">
                    @csrf
                    <div class="input_div">
                        <label for="numerocompte">Votre numéro de compte</label>
                        <input name="numerocompte" type="text" value="FR76" placeholder="Votre numéro de compte">
                        <x-input-error :messages="$errors->get('numerocompte')" class="alert" />
                    </div>
                    
                    <div class="input_div">
                        <label for="nomcompte">Le nom de votre compte</label>
                        <input name="nomcompte" type="text" placeholder="Le nom de votre compte">
                        <x-input-error :messages="$errors->get('nomcompte')" class="alert" />
                    </div>
                        
                        <input id="submit_button" type="submit" value="Enregistrer mes infos bancaire">

                    </form>
                    @if(session('message'))
                    <div class="message">
                        {{ session('message') }}
                    </div>
                    @endif
            @endif
        </div>
        <div id="carte_bancaire_div">
            <h1>Ma carte bancaire</h1>
            @if(count($carte_bancaire) > 0)

                @foreach ($carte_bancaire as $carte)
                <div>

                    <form id="form_carte_bancaire" action="{{ route('updatecartebancaire') }}" method="post">
                        @csrf
                        <div class="input_div">
                            <label for="numerocarte">Votre numéro de carte</label>
                            <input name="numerocarte" type="text" value="{{ $carte-> numerocarte}}" placeholder="Votre numéro de carte">
                            <x-input-error :messages="$errors->get('numerocarte')" class="alert" />
                        </div>

                        <div class="input_div">
                            <label for="dateexpiration">La date d'expiration de votre carte</label>
                            <input name="dateexpiration" type="text" value="{{ $carte->dateexpiration }}" placeholder="Date d'expiration">
                            <x-input-error :messages="$errors->get('dateexpiration')" class="alert" />
                        </div>

                        <div class="input_div">
                            <label for="cryptogramme">Le cryptogramme de votre carte</label>
                            <input name="cryptogramme" type="text" value="{{ $carte->cryptogramme }}" placeholder="Cryptogramme">
                            <x-input-error :messages="$errors->get('cryptogramme')" class="alert" />
                        </div>

                        <div class="input_div">
                            <label for="nomcarte">Le nom de votre carte</label>
                            <input name="nomcarte" type="text" value="{{ $carte->nomcarte }}" placeholder="Le nom de votre carte">
                            <x-input-error :messages="$errors->get('nomcarte')" class="alert" />
                        </div>
                        <input id="submit_button" type="submit" value="Enregistrer ma carte">
                    </form>

                    <form action="{{ route('suppcartebancaire') }}" method="post">
                        @csrf
                        <input class="sumbit_delete_button" id="submit_button" type="submit" value="Supprimer ma carte bancaire">
                    </form>
                </div>
                    
                    
                    
                    
                @endforeach

            @else

                <form id="form_carte_bancaire" action="{{ route('addcartebancaire') }}" method="post">
                @csrf
                    <div class="input_div">
                        <label for="numerocarte">Votre numéro de carte</label>
                        <input name="numerocarte" type="text"  placeholder="Votre numéro de carte">
                        <x-input-error :messages="$errors->get('numerocarte')" class="alert" />
                    </div>
                    
                    <div class="input_div">
                        <label for="dateexpiration">La date d'expiration de votre carte</label>
                        <input name="dateexpiration" type="text"  placeholder="Date d'expiration">
                        <x-input-error :messages="$errors->get('dateexpiration')" class="alert" />
                    </div>

                    <div class="input_div">
                        <label for="cryptogramme">Le cryptogramme de votre carte</label>
                        <input name="cryptogramme" type="text"  placeholder="Cryptogramme">
                        <x-input-error :messages="$errors->get('cryptogramme')" class="alert" />
                    </div>

                    <div class="input_div">
                        <label for="nomcarte">Le nom de votre carte</label>
                        <input name="nomcarte" type="text"  placeholder="Le nom de votre carte">
                        <x-input-error :messages="$errors->get('nomcarte')" class="alert" />
                    </div>

                    <input id="submit_button" type="submit" value="Enregistrer ma carte">
                </form>

                

            @endif
        </div>

        
    </div>
</x-app-layout>