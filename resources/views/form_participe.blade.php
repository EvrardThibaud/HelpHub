<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_inscription.blade.css">
    <title>Formulaire d'Inscription à une Action Bénévole</title>
</head>
<body>
    @include('includes.header')

    <div id="content">

        <div id="info">

            <h1>Inscription à une Action Bénévole</h1>

            <p>
                Remplissez le formulaire ci-dessous pour vous inscrire à notre action bénévole.
            </p>

            <p>Les champs marqués d'un astérisque (*) sont obligatoires</p>

        </div>

        <form action="{{ route('participer') }}" method="post" enctype="multipart/form-data">
    @csrf

            <div class="input_div">
                <label for="gender">Civilité</label>
                <select name="gender"> 
                    <option value="none">Veuillez choisir votre genre</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select>
            </div>

            <div class="input_div">
                <label for="nom">Nom*</label>
                <input type="text" name="nom" required>  
            </div>

            <div class="input_div">
                <label for="prenom">Prénom*</label>
                <input type="text" name="prenom" required>  
            </div>

            <div class="input_div">
                <label for="email">Adresse Email*</label>
                <input type="email" name="email" required placeholder="exemple@helpub.com">  
            </div>

            <div class="input_div">
                <label for="numtelephone">Numéro de Téléphone*</label>
                <input type="text" name="numtelephone" required placeholder="00 00 00 00 00">  
            </div>

            <div class="input_div">
                <label for="dob">Date de Naissance*</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="input_div" id="parental_agreement_div">
                <label for="parental_agreement">Accord Parental (moins de 18 ans)</label>
                <input type="file" onchange="checkAge()" id="parental_agreement" name="parental_agreement">
            </div>

            <div class="input_div">
                <label for="motivation">Motivation</label>
                <textarea name="motivation" required></textarea>
            </div>

            <input type="submit" id="submit_button" value="S'Inscrire">
        </form>

        <script>
            function checkAge() {
                var dobInput = document.getElementById('dob');
                var parentalAgreementDiv = document.getElementById('parental_agreement_div');
                var parentalAgreementInput = document.getElementById('parental_agreement');
                var submitButton = document.getElementById('submit_button');

                // Récupérer la date de naissance
                var dob = new Date(dobInput.value);

                // Calculer l'âge
                var age = new Date().getFullYear() - dob.getFullYear();

                // Afficher ou masquer le champ d'accord parental en fonction de l'âge
                parentalAgreementDiv.style.display = age < 18 ? 'block' : 'none';

                // Activer ou désactiver le bouton de soumission en fonction de l'âge
                submitButton.disabled = age < 18 && parentalAgreementInput.value.trim() === '';
            }
        </script>

    </div>
    @include('includes.footer')

</body>
</html>
