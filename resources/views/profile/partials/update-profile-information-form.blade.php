<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Information de profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez ici à jour vos informations de profil utilisateur.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="prenomutilisateur" :value="__('Prénom')" />
            <x-text-input id="prenomutilisateur" name="prenomutilisateur" type="text" class="mt-1 block w-full" :value="old('prenomutilisateur', $user->prenomutilisateur)" required autofocus autocomplete="prenomutilisateur" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nomutilisateur" :value="__('Nom')" />
            <x-text-input id="nomutilisateur" name="nomutilisateur" type="text" class="mt-1 block w-full" :value="old('nomutilisateur', $user->nomutilisateur)" required autofocus autocomplete="nomutilisateur" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif -->
        </div>

        <div>
            <x-input-label for="numtelephone" :value="__('Numéro de téléphone')" />
            <x-text-input id="numtelephone" name="numtelephone" type="text" class="mt-1 block w-full" :value="old('numtelephone', $user->numtelephone)" required autofocus autocomplete="numtelephone" />
            <x-input-error class="mt-2" :messages="$errors->get('numtelephone')" />
        </div>

        <div>
            <x-input-label for="adresse" :value="__('Rue')" />
            <x-text-input id="adresse" name="rue" type="text" class="mt-1 block w-full" :value="old('rue', $user->rue)" required autofocus autocomplete="rue" />
            <x-text-input id="villeadresse" style="display: none;" name="villeadresse" type="text" :value="old('villeadresse', $user->adresse->villeadresse)" r />
            <x-input-error class="mt-2" :messages="$errors->get('rue')" />

            <ul id="les_adresses">

            </ul>

        </div>

        <div>
            <x-input-label for="codepostaladresse" :value="__('Code postal')" />
            <x-text-input id="codepostaladresse" name="codepostaladresse" type="text" class="mt-1 block w-full" :value="old('codepostaladresse', $user->codepostaladresse)" required autofocus autocomplete="codepostaladresse" />
            <x-input-error class="mt-2" :messages="$errors->get('codepostaladresse')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Informations sauvegardées.') }}</p>
            @endif
        </div>
    </form>
</section>
<script>

        let timeoutId;
        // Supposons que vous avez un événement lorsque l'utilisateur tape quelque chose dans l'input
        let input = document.getElementById('adresse'); // Obtenez votre élément d'input
        

        function getAddress(userInput) {
            fetch('/get-address-suggestions?input=' + encodeURIComponent(userInput))
                .then(response => response.json())
                .then(data => {
                    let lesadresses = document.getElementById('les_adresses');
                    lesadresses.innerHTML = "";

                    if (data && data.features && Array.isArray(data.features)) {
                        let firstWord = userInput.split(' ')[0]; // Récupérer le premier mot

                        // Vérifier si le premier mot est un chiffre
                        if (/^\d+$/.test(firstWord)) {
                            data.features.forEach(feature => {
                                let addressLabel = firstWord + ' ' + feature.properties.label; // Concaténer avec la suggestion d'adresse

                                let i = document.createElement('li');
                                i.innerHTML = addressLabel;
                                lesadresses.appendChild(i);
                                lesadresses.style.display = "block";
                                i.addEventListener("click", function(){
                                    let city = document.getElementById("codepostaladresse")
                                    let ville = document.getElementById('villeadresse')
                                    city.value = feature.properties.postcode
                                    ville.value = feature.properties.city
                                    input.value = firstWord + ' ' +feature.properties.name
                                    lesadresses.innerHTML = ""
                                })
                            });
                        } else {
                            data.features.forEach(feature => {
                                let i = document.createElement('li');
                                i.innerHTML = feature.properties.label; // Ajouter la suggestion d'adresse sans le numéro de rue
                                lesadresses.appendChild(i);
                                lesadresses.style.display = "block";

                                i.addEventListener("click", function(){
                                    let city = document.getElementById("codepostaladresse")
                                    let ville = document.getElementById('villeadresse')
                                    city.value = feature.properties.postcode
                                    ville.value = feature.properties.city
                                    input.value = feature.properties.name
                                    lesadresses.innerHTML = ""
                                })
                            });
                        }
                    } 
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite : ', error);
                });
        }

        input.addEventListener('input', function() {
            let userInput = input.value;
            getAddress(userInput);
            
        });


        input.addEventListener('blur', () => {
        timeoutId = setTimeout(() => {
            let lesadresses = document.getElementById('les_adresses');
            lesadresses.style.display = "none"
            lesadresses.innerHTML = ""
        }, 150); // Ajoute un délai de 200 millisecondes avant de masquer la liste
        });

        input.addEventListener('focus', () => {
        clearTimeout(timeoutId); // Réinitialise le délai si l'input redevient en focus
        getAddress(input.value);
        });

    </script>
