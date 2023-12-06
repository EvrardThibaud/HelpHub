@section('title', 'HelpHub - Inscription')
<x-guest-layout>
    <div id="content">
            <form id="form_register" method="POST" action="{{ route('register_association') }}">
            @csrf
            
            <!-- Nom -->
            <div class="input_div">
                <x-input-label for="nomassociation" :value="__('Votre nom d\'association')" />
                <x-text-input id="nomassociation" class="" type="text" name="nomassociation" :value="old('nomassociation')" required autofocus autocomplete="nomassociation"  />
                <x-input-error :messages="$errors->get('name')" class="alerte" />
            </div>
    
    
            <!-- Email Address -->
            <div class="input_div">
                <x-input-label for="mailassociation" :value="__('Votre adresse mail')" />
                <x-text-input id="mailassociation" class="" type="email" name="mailassociation" :value="old('mailassociation')" required autocomplete="email" placeholder="exemple@helphub.com"/>
                <x-input-error :messages="$errors->get('email')" class="alerte" />
            </div>
    

            <!-- num tel -->
            <div class="input_div">
                <x-input-label for="numtelassociation" :value="__('Votre numéro de téléphone :')" />
                <x-text-input id="numtelassociation" class="" type="text" name="numtelassociation" :value="old('numtelassociation')" required autocomplete="numtelassociation" placeholder="00 00 00 00 00"/>
                <x-input-error :messages="$errors->get('numtelassociation')" class="alert" />
            </div>

            <!-- site web -->
            <div class="input_div">
                <x-input-label for="sitewebassociation" :value="__('Votre site internet :')" />
                <x-text-input id="sitewebassociation" class="" type="text" name="sitewebassociation" :value="old('sitewebassociation')" required autocomplete="sitewebassociation" placeholder="https://helphub.com"/>
                <x-input-error :messages="$errors->get('sitewebassociation')" class="alert" />
            </div>

            <!-- description -->
            <div class="input_div">
                <x-input-label for="descriptionassociation" :value="__('Votre description :')" />
                <x-text-input id="descriptionassociation" class="" type="text" name="descriptionassociation" :value="old('descriptionassociation')" required autocomplete="descriptionassociation"/>
                <x-input-error :messages="$errors->get('descriptionassociation')" class="alert" />
            </div>

            <!-- Password -->
            <div class="input_div">
                <x-input-label for="password" :value="__('Votre mot de passe')" />
    
                <x-text-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="alerte" />
            </div>

    
            <!-- Confirm Password -->
            <div class="input_div">
                <x-input-label for="password_confirmation" :value="__('Confirmez votre mot de passe')" />
    
                <x-text-input id="password_confirmation" class=""
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="alerte" />
            </div>
    
            
    
            <div class="">
                <x-primary-button id="submit_button">
                    {{ __('Créer votre compte') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
