
@section('title', 'HelpHub - Identification')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <div id="content">
        
        <form method="POST" action="{{ route('login') }}">
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
            
            <!-- Remember Me -->
            <!-- <div id="remember_me_div">
                <label for="remember_me" class="">
                    <input id="remember_me" type="checkbox" class="" name="remember">
                    <span class="">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>
        -->
        <div class="">
                
            
            <x-primary-button id="submit_button">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
        <a class="" href="{{ route('register') }}">
                {{ __('J\'ai déjà un compte') }}
            </a>
        </form>

    </div>
</x-guest-layout>

@include('includes.footer')

