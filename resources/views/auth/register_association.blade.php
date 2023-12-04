@section('title', 'HelpHub - Inscription')
<x-guest-layout>
    <div id="content">
            <form id="form_register" method="POST" action="{{ route('register_association') }}">
            @csrf
            
            <!-- Nom -->
            <div class="input_div">
                <x-input-label for="nomutilisateur" :value="__('Votre nom')" />
                <x-text-input id="nomutilisateur" class="" type="text" name="nomutilisateur" :value="old('nomutilisateur')" required autofocus autocomplete="nomutilisateur" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
    
            <!-- Email Address -->
            <div class="input_div">
                <x-input-label for="email" :value="__('Votre adresse mail')" />
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="input_div">
                <x-input-label for="password" :value="__('Votre mot de passe')" />
    
                <x-text-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="input_div">
                <x-input-label for="password_confirmation" :value="__('Confirmez votre mot de passe')" />
    
                <x-text-input id="password_confirmation" class=""
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            
    
            <div class="">
    
                <x-primary-button id="submit_button">
                    {{ __('Créer votre compte') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-guest-layout>
