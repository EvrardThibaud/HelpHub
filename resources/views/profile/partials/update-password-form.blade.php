<section>
    <header>
        <h1 class="">
            {{ __('Modifier votre mot de passe') }}
        </h1>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="">
        @csrf
        @method('put')

        <div class="input_div">
            <x-input-label for="current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="current_password" name="current_password" type="password" class="" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="" />
        </div>

        <div class="input_div">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="password" name="password" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="" />
        </div>

        <div class="input_div">
            <x-input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="" />
        </div>

        <div class="input_div">
            <x-primary-button id="submit_button">{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 10000)"
                    class=""
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
