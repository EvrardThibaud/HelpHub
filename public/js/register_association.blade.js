
let timeoutId;
// Supposons que vous avez un événement lorsque l'utilisateur tape quelque chose dans l'input
let input = document.getElementById('adresse'); // Obtenez votre élément d'input

function getAddress(userInput) {
    if(userInput.length >= 3){

    
    fetch('https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(userInput) + '&type=street&autocomplete=1&limit=5')
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
