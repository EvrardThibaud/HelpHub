<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.blade.css">
    <title>Contacter le DPO</title>
</head>
<body>

    @include('includes.header')
    <h1>Contactez le délégué à la protection des données</h1>

    <div id="content">

        <div id="info">            

            <p>
               
            Ce formulaire ne doit pas être utilisé si votre demande concerne un autre organisme que HepHub (ex : opposition à recevoir de la publicité, déréférencement d'un contenu internet, etc.). </p> <p>Dans ce cas, utilisez notre service d'aide en ligne pour obtenir une réponse immédiate.
            </p>

            <p>Les champs marqués d'un astérisque (*) sont obligatoires</p>
        </div>

        <form action="{{ route('contact.submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input_div">
                <label for="gender">Civilité</label>
                <select name="gender" > 
                    <option value="none">Préfère ne pas répondre</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <div class="input_div">
                   <x-input-label for="nomutilisateur" :value="__('Votre nom* :')" />
                   <x-text-input id="nomutilisateur" class="" type="text" name="nomutilisateur" :value="old('nomutilisateur')" required autofocus autocomplete="nomutilisateur" />
                   <x-input-error :messages="$errors->get('name')" class="alert" />
               </div>

            <div class="input_div">
                <label for="first_name">Prénom*</label>
                <input type="text" name="first_name" required>  
            </div>

            <div class="input_div">
                   <x-input-label for="email" :value="__('Votre adresse mail* :')" />
                   <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="exemple@helpub.com"/>
                   <x-input-error :messages="$errors->get('email')" class="alert" />
               </div>

            <div class="input_div">
                   <x-input-label for="numtelephone" :value="__('Votre numéro de téléphone* :')" />
                   <x-text-input id="numtelephone" class="" type="text" name="numtelephone" :value="old('numtelephone')" required autocomplete="numtelephone" placeholder="00 00 00 00 00"/>
                   <x-input-error :messages="$errors->get('numtelephone')" class="alert" />
               </div>

            <div class="input_div">
                <label for="message">Votre message*</label>
                <textarea  name="message" required></textarea>
            </div>

            <div class="input_div">
                <label for="subject">Objet de votre message*</label>
                <select name="subject">
                    <option value="droit_acces">Droit d'accès d'un traitement de données de HelpHub</option>
                    <option value="droit_rectification">Droit de rectification d'un traitement de données de HelpHub</option>
                    <option value="droit_effacement">Droit à l'effacement sur une donnée de HelpHub</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <div class="input_div">
                <label for="attachment">Pièce jointe</label>
                <input type="file" name="attachment">
            </div>

            <input type="submit" id="submit_button" value="Transférer">
        </form>

        <div id="validation-popup" style="display: none;">
            <p>Cette question sert à vérifier si vous êtes un visiteur humain ou non afin d'éviter les soumissions de pourriel (spam) automatisées.</p>
            <input type="text" name="captcha_code" placeholder="Code de vérification">
            <button onclick="validateForm()">Valider</button>
        </div>

        <div id="confirmation" style="display: none;">
            <div class="container">
                <h1>Formulaire validé avec succès!</h1>
                <p>Merci pour votre message. Nous traiterons votre demande dans les plus brefs délais.</p>
            </div>
        </div>

    </div>
    @include('includes.footer')

    <script>
        function showValidationPopup() {
            document.getElementById('validation-popup').style.display = 'block';
        }

        function validateForm() {
            alert('Formulaire validé avec succès!');
            document.getElementById('confirmation').style.display = 'block';
        }
    </script>


</body>
</html>
    