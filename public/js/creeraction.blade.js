// =====================================================================================
// =====================================================================================
//                                    Auto complétion adresse
// =====================================================================================
// =====================================================================================

let timeoutId;
let input = document.getElementById('adresse'); // Obtenez votre élément d'input

function getAddress(userInput) {
    if(userInput.length >= 3){
        fetch('https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(userInput) + '&type=street&autocomplete=1&limit=5')
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

                            let coordonneex = document.getElementById('coordonnex')
                            coordonneex.value = feature.geometry.coordinates[0]

                            let coordonneey = document.getElementById('coordonney')
                            coordonneey.value = feature.geometry.coordinates[1]

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

                            let coordonneex = document.getElementById('coordonnex')
                            coordonneex.value = feature.geometry.coordinates[0]

                            let coordonneey = document.getElementById('coordonney')
                            coordonneey.value = feature.geometry.coordinates[1]
                            
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
    
})
input.addEventListener('blur', () => {
    timeoutId = setTimeout(() => {
        let lesadresses = document.getElementById('les_adresses');
        lesadresses.style.display = "none"
        lesadresses.innerHTML = ""
    }, 200); // Ajoute un délai de 200 millisecondes avant de masquer la liste
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

        if(typeAction.innerHTML == "Information")
            localStorage.setItem('formulaireAffiche', 'Information');
        else if(typeAction.innerHTML == "Don")
            localStorage.setItem('formulaireAffiche', 'Don');
        else
            localStorage.setItem('formulaireAffiche', 'Bénévolat');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const formulaireAffiche = localStorage.getItem('formulaireAffiche');
    const contentDivs = document.querySelectorAll('#content > div');

    if (formulaireAffiche) {
        contentDivs.forEach(function(div) {
            if (div.id === 'form-' + formulaireAffiche) {
                div.classList.remove('hide');
            } else {
                div.classList.add('hide');
            }
        });

        const typeActions = document.querySelectorAll('.type_action');
        typeActions.forEach(function(typeAction) {
            if (typeAction.innerHTML.toLowerCase() === formulaireAffiche.toLowerCase()) {
                typeAction.classList.add('active');
            } else {
                typeAction.classList.remove('active');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const formulaireAffiche = localStorage.getItem('formulaireAffiche');

    if (formulaireAffiche === 'don') {
      
    } else {
        
    }
});

// =====================================================================================
// =====================================================================================
//                                    validation formulaire
// =====================================================================================
// =====================================================================================

    function checkFormthematique(event, parent){
        var checkboxes = parent.querySelectorAll('input[type="checkbox"]');
        var isChecked = false;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            alert('Veuillez cocher au moins une thématique.');
            event.preventDefault();
        }
    }

    document.getElementById('form_benevolat').addEventListener('submit', function(event) {
        let them_benevolat = document.getElementById('them_benevolat');
        checkFormthematique(event,them_benevolat);
    });
    document.getElementById('form_don').addEventListener('submit', function(event) {
        let them_don = document.getElementById('them_don');
        checkFormthematique(event, them_don);
    });
    document.getElementById('form_information').addEventListener('submit', function(event) {
        let them_information = document.getElementById('them_information');
        checkFormthematique(event, them_information);
    });

    document.getElementById('form_don').addEventListener('submit', function(event) {
        const ribInput = document.getElementById('ribdon');
        const regexIBAN_FR = /^FR\d{2}(\s|-)?\d{4}(\s|-)?\d{4}(\s|-)?\d{4}(\s|-)?\d{4}(\s|-)?\d{4}(\s|-)?\d{3}$/;
    
        const trimmedIBAN = ribInput.value.trim(); // Enlève les espaces avant et après la valeur IBAN
    
        if (!regexIBAN_FR.test(trimmedIBAN)) {
            event.preventDefault();
            alert('Veuillez entrer un IBAN français valide. \n Ex: FR00 0000 0000 0000 0000 0000 000 \n ou: FR00-0000-0000-0000-0000-0000-000 \n ou: FR0000000000000000000000000');
        }

    });
    

    function clearDefaultText() {
        var input = document.getElementById('competencesrequisesdb');
        if (input.value === 'Aucune') {
            input.value = '';
        }
    }
    
    function resetDefaultText() {
        var input = document.getElementById('competencesrequisesdb');
        if (input.value === '') {
            input.value = 'Aucune';
        }
    }

// =====================================================================================
// =====================================================================================
//                                    mot cle
// =====================================================================================
// =====================================================================================



function addMotCle(type) {
    let parent = document.querySelector(`#lesmotcles${type}`);
    let input = document.querySelector(`#motcles${type}`);
    let value = document.querySelector(`#letmotcle${type}`);
    if (value.value.trim() !== '') {
        let lesMotsCles = document.querySelectorAll(`.${type}`);

        let dejaMotCle = false;

        lesMotsCles.forEach(motcle => {
            if (motcle.innerHTML.includes(value.value))
                dejaMotCle = true;
        });

        if (!dejaMotCle) {
            let div = document.createElement('div');
            div.classList.add('motcle');
            div.innerHTML = value.value;
            parent.appendChild(div);
            
            input.value = input.value + value.value + " ";

            div.addEventListener("click", () => {
                div.remove();
                let updatedMotsCles = document.querySelectorAll(`.${type}`);
                input.value = "";
                
                updatedMotsCles.forEach(element => { 
                    input.value += element.innerHTML + " ";
                });
            });
            
            value.value = "";
        }
    }
}

let types = ['benevolat', 'information', 'don'];

types.forEach(type => {
    let submit = document.querySelector(`#submitmotcle${type}`);
    submit.addEventListener('click', () => {
        addMotCle(type);
    });
});

