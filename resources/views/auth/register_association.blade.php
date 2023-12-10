@section('title', 'Inscription Association - HelpHub')
<x-guest-layout>
    <div id="content">
        <h1>Créer un compte d'association</h1>
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
                <x-input-label for="email" :value="__('Votre adresse mail')" />
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="exemple@helphub.com"/>
                <x-input-error :messages="$errors->get('email')" class="alerte" />
            </div>
    

            <!-- num tel -->
            <div class="input_div">
                <x-input-label for="numtelassociation" :value="__('Votre numéro de téléphone :')" />
                <x-text-input id="numtelassociation" class="" type="text" name="numtelassociation" :value="old('numtelassociation')" required autocomplete="numtelassociation" placeholder="00 00 00 00 00"/>
                <x-input-error :messages="$errors->get('numtelassociation')" class="alert" />
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
                                    city.value = feature.properties.postcode
                                    let ville = document.getElementById('villeadresse')
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
                                    city.value = feature.properties.postcode
                                    let ville = document.getElementById('villeadresse')
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
        }, 200); // Ajoute un délai de 200 millisecondes avant de masquer la liste
        });

        input.addEventListener('focus', () => {
        clearTimeout(timeoutId); // Réinitialise le délai si l'input redevient en focus
        getAddress(input.value);
        });

    </script>
</x-guest-layout>
