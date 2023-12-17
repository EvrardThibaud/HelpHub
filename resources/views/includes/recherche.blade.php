<!-- Formulaire de recherche -->
<head>    
    <link rel="stylesheet" href="css/formulaire_recherche.blade.css">
    <link rel="stylesheet" href="css/adressecompletion.css">
    

</head>
<div id="div_form_recherche" >
    <h2>Je trouve ma mission</h2>
    <form id="form_recherche_association"   action="/recherche" method="GET">

        <!-- Mot clé -->
        <div id="motcle" class="input_div">
            <p>Mots clés</p>
            <input type="text" id="motcles" name="motcles" placeholder="Exemple: Aide, marche"
            value="{{ isset($motcles) ? $motcles : '' }}">
        </div>


        <!-- Lieu -->
        <div id="lieu" class="input_div">
            <!-- <h3>Code postal / ville</h3> -->
            <p>Choisissez un lieu : </p>
            <input type="text" id="codepostal" name="codepostal" placeholder="Exemple: 75000, Paris" 
            value="{{ isset($codepostal) ? $codepostal : '' }}">
            <ul id="les_adresses">
                
            </ul>
        </div>

        <!-- Date -->
        <div id="date" class="input_div">
            <!-- <h3>Date</h3> -->
            <p>Trier par date :</p>


            <input type="radio" id="triage_nul" name="triagedate" value="0" 
            @if (isset($triage_choisie))
                {{ $triage_choisie == '0' ? 'checked' : '' }}
            @else
                checked
            @endif>
            <label for="triage_nul">Aucun triage</label><br>

            <input type="radio" id="triage_plus_recent" name="triagedate" value="1" 
            @if (isset($triage_choisie))
                {{ $triage_choisie == '1' ? 'checked' : '' }}
            @endif>
            <label for="triage_plus_recent">Plus récents d'abord</label><br>
            
            <input type="radio" id="triage_plus_ancien" name="triagedate" value="2" 
            @if (isset($triage_choisie))
                {{ $triage_choisie == '2' ? 'checked' : '' }}
            @endif>
            <label for="triage_plus_ancien">Plus anciens d'abord</label><br>
        </div>


        <!-- Association -->
        <div id="association">
            <p>Choisissez une association :</p>
            <select name="association">
                <option value="-">Toutes les associations</option>
                @foreach ($associations as $association)
                    <option value="{{ $association->idassociation }}"
                        @if (isset($association_choisie) && $association_choisie->idassociation != '-')
                            {{ $association->idassociation == $association_choisie->idassociation ? 'selected' : '' }}
                        @endif
                    >{{ $association->nomassociation }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- thématique -->
        <div id="thematique">
            <!-- <h3>Thématique</h3> -->
            <p>Choisissez une thématique :</p>
            <select name="thematique">
                <option value="-">Tous type de thématique</option>
                @foreach ($thematiques as $thematique)
                    <option value="{{ $thematique->idthematique }}" 
                        @if (isset($thematique_choisie) && $thematique_choisie->idthematique != '-')
                            {{ $thematique->idthematique == $thematique_choisie->idthematique ? 'selected' : '' }}
                        @endif
                        >{{ $thematique->libellethematique }} 
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Envoyer -->
        <div>
            <input type="submit" value="Rechercher">
        </div>
        <div>
            <a id="reset">Réinitialiser les filtres</a>
        </div>
    </form>
</div>

<script>
        let timeoutId;

        let input = document.getElementById('codepostal'); // Obtenez votre élément d'input
        
        function getAddress(userInput){
            fetch('/get-address-suggestions?input=' + encodeURIComponent(userInput))
                .then(response => response.json())
                .then(data => {
                    let lesadresses = document.getElementById('les_adresses');
                    lesadresses.innerHTML = "";

                    

                    if (data && data.features && Array.isArray(data.features)) {
                  
                        data.features.forEach(feature => {
                            let i = document.createElement('li');
                            i.innerHTML = feature.properties.label;
                            lesadresses.appendChild(i);
                            lesadresses.style.display = "block"
                            i.addEventListener("click", function(){
                                
                                input.value = feature.properties.postcode
                                lesadresses.innerHTML = ""
                            })
                        });
                       
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
        }, 100); // Ajoute un délai de 200 millisecondes avant de masquer la liste
        });

        input.addEventListener('focus', () => {
        clearTimeout(timeoutId); // Réinitialise le délai si l'input redevient en focus
        getAddress(input.value);
        });

        let reset = document.getElementById('reset');

        reset.addEventListener('click', () => {
            event.preventDefault(); // Pour éviter le comportement par défaut du lien

            // Récupère le formulaire
            let form = document.getElementById('form_recherche_association');

            // Réinitialise les valeurs des champs du formulaire
            form.querySelectorAll('input, select').forEach(function(field) {
                if (field.type === 'radio' || field.type === 'checkbox') {
                    field.checked = false;
                } else if (field.tagName === 'SELECT') {
                    // Sélectionne le premier élément dans les balises <select>
                    field.selectedIndex = 0;
                } else {
                    field.value = '';
                }


            });

            let triage_nul = document.getElementById('triage_nul');
            triage_nul.checked = true;

            form.submit();
        });

    </script>