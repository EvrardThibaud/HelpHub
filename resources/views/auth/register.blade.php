@section('title', 'Inscription - HelpHub')
<x-guest-layout>



    <div id="content">
        <h1>Créer un compte d'utilisateur</h1>


            
            <form id="form_register" method="POST" action="{{ route('register') }}">
            @csrf


            <div id="form_input">
                <!-- Prenom -->
               <div class="input_div">
                   <x-input-label for="prenomutilisateur" :value="__('Votre prénom :')" />
                   <x-text-input id="prenomutilisateur" class="" type="text" name="prenomutilisateur" :value="old('prenomutilisateur')" required autofocus autocomplete="prenomutilisateur"/>
                   <x-input-error :messages="$errors->get('name')" class="alert" />
               </div>
       
               <!-- Nom -->
               <div class="input_div">
                   <x-input-label for="nomutilisateur" :value="__('Votre nom :')" />
                   <x-text-input id="nomutilisateur" class="" type="text" name="nomutilisateur" :value="old('nomutilisateur')" required autofocus autocomplete="nomutilisateur" />
                   <x-input-error :messages="$errors->get('name')" class="alert" />
               </div>
       
               <!-- Email Address -->
               <div class="input_div">
                   <x-input-label for="email" :value="__('Votre adresse mail :')" />
                   <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="exemple@helpub.com"/>
                   <x-input-error :messages="$errors->get('email')" class="alert" />
               </div>
       
       
               <!-- num tel -->
               <div class="input_div">
                   <x-input-label for="numtelephone" :value="__('Votre numéro de téléphone :')" />
                   <x-text-input id="numtelephone" class="" type="text" name="numtelephone" :value="old('numtelephone')" required autocomplete="numtelephone" placeholder="00 00 00 00 00"/>
                   <x-input-error :messages="$errors->get('numtelephone')" class="alert" />
               </div>
       
               <!-- Adresse -->
               <div class="input_div">
                   <x-input-label for="adresse" :value="__('Votre adresse :')" />
                   <x-text-input id="adresse" class="" type="text" placeholder="9 rue de l'arc en ciel" name="rue" :value="old('rue')" required autocomplete="rue"/>
                   <input type="text" name="villeadresse" style="display: none;" id="villeadresse" value="">
                   <x-input-error :messages="$errors->get('rue')" class="alert" />
                   
                    <ul id="les_adresses">

                    </ul>
               </div>
       
               <!-- Code postal -->
               <div class="input_div">
                   <x-input-label for="codepostaladresse" :value="__('Votre code postal :')" />
                   <x-text-input id="codepostaladresse" class="" type="text" name="codepostaladresse" :value="old('codepostaladresse')" placeholder="74000" required />
                   <x-input-error :messages="$errors->get('codepostaladresse')" class="alert" />
               </div>
       
       
               <!-- Password -->
               <div class="input_div">
                   <x-input-label for="password" :value="__('Votre mot de passe :')" />
       
                   <x-text-input id="password" class=""
                                   type="password"
                                   name="password"
                                   required autocomplete="new-password" placeholder="(./*?!%=+-,:;§$€^)"/>
       
                   <x-input-error :messages="$errors->get('password')" class="alert" />
               </div>
       
               <!-- Confirm Password -->
               <div class="input_div">
                   <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe :')" />
       
                   <x-text-input id="password_confirmation" class=""
                                   type="password"
                                   name="password_confirmation" required autocomplete="new-password"/>
       
                   <x-input-error :messages="$errors->get('password_confirmation')" class="alert" />
               </div>

            </div>
            
            <div id="form_over">

                <div id="form_to_check_div">
                    <!-- Ajout de la case à cocher pour la newsletter -->
                    <div id="newsletter_div">
                        <label for="newsletter" class="">
                            <input type="checkbox" id="newsletter" name="newsletter" class="form-checkbox">
                            <span class="ml-2 text-sm">{{ __('S\'abonner à la newsletter') }}</span>
                        </label>
                    </div>
            
                    <!-- Ajout de la case à cocher pour la notification -->
                    <div id="notifications_div">
                        <label for="notifications" class="flex items-center">
                            <input type="checkbox" id="notifications" name="notifications" class="form-checkbox">
                            <span class="ml-2 text-sm">{{ __('Activer les notifications') }}</span>
                        </label>
                    </div>

                </div>

                
        
                <div id="form_login_submit">
                    
                    <x-primary-button id="submit_button">
                        {{ __('Créer votre compte') }}
                    </x-primary-button>
                    <a class="" href="{{ route('login') }}">
                        {{ __('Vous avez déjà un compte?') }}
                    </a>
                </div>

                <p><a class="" href="{{ route('persocookies') }}">
                        {{ __('Gérer les cookies') }}
                    </a>

            </div>

            <div ><a href="{{ route('info_register') }}">Pourquoi ?</a></div>
            
        </form>

        
        
    </div>
    
    @include('includes.footer')
<script src="js/register.blade.js" defer></script>
</x-guest-layout>
