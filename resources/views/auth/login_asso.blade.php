
@section('title', 'HelpHub - Identification Association')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <div id="content">
        
        <h1>Se connecter en tant qu'association</h1>
        <form method="POST" action="{{ route('login_asso') }}">
            @csrf

            @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
            @endif
    
            <!-- Email Address -->
            <div class="input_div">
                <x-input-label for="email" :value="__('Votre adresse email : ')" />
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@helphub.com"/>
                <x-input-error  :messages="$errors->get('email')" class="alert" />
            </div>
    
            <!-- Password -->
            <div class="input_div">
                <x-input-label for="password" :value="__('Votre mot de passe :')" />
    
                <x-text-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error class="alert" :messages="$errors->get('password')"  />
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('J\'ai oublié mon mot de passe') }} 
                    </a>
                @endif
            </div>

        <div class="">
                
            
            <x-primary-button id="submit_button">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
            <a class="" href="{{ route('register_association') }}">
                {{ __('Je n\'ai pas encore de compte.') }}
            </a>
            <a class="" href="{{ route('login') }}">
                {{ __('Je ne suis pas une association.') }}
            </a>
        </form>

    </div>
</x-guest-layout>

@include('includes.footer')

