// =====================================================================================
// =====================================================================================
//                                    Auto complétion adresse
// =====================================================================================
// =====================================================================================

let timeoutId;
let input = document.getElementById('adresse'); // Obtenez votre élément d'input

function getAddress(userInput) {
    fetch('/get-address-suggestions?input=' + encodeURIComponent(userInput))
        .then(response => response.json())
        .then(data => {
            let lesadresses = document.getElementById('les_adresses');
            lesadresses.innerHTML = ""
            if (data && data.features && Array.isArray(data.features)) {
                let firstWord = userInput.split(' ')[0]; // Récupérer le premier mo
                // Vérifier si le premier mot est un chiffre
                if (/^\d+$/.test(firstWord)) {
                    data.features.forEach(feature => {
                        let addressLabel = firstWord + ' ' + feature.properties.label; // Concaténer avec la suggestion d'adress
                        let i = document.createElement('li');
                        i.innerHTML = addressLabel;
                        lesadresses.appendChild(i);
                        lesadresses.style.display = "block"
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
                        lesadresses.style.display = "block"
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
    
})
input.addEventListener('blur', () => {
    timeoutId = setTimeout(() => {
        let lesadresses = document.getElementById('les_adresses');
        lesadresses.style.display = "none"
        lesadresses.innerHTML = ""
    }, 100); // Ajoute un délai de 200 millisecondes avant de masquer la liste
})
input.addEventListener('focus', () => {
    clearTimeout(timeoutId); // Réinitialise le délai si l'input redevient en focus
    getAddress(input.value);
})



// =====================================================================================
// =====================================================================================
//                                    changement formulaire
// =====================================================================================
// =====================================================================================
let typeActions = document.querySelectorAll('.type_action');

typeActions.forEach(function(typeAction) {
    typeAction.addEventListener('click', function() {
        // Ajouter la classe active à l'élément cliqué et la supprimer des autres
        typeActions.forEach(function(action) {
            action.classList.remove('active');
        });
        typeAction.classList.add('active');

        let typeActionId = "form-" + typeAction.innerHTML;
        let contentDivs = document.querySelectorAll('#content > div');

        contentDivs.forEach(function(div) {
            if (div.id === typeActionId) {
                div.classList.remove('hide');
            } else {
                div.classList.add('hide');
            }
        });
    });
});

