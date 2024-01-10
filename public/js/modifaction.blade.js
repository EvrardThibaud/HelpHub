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

let submit = document.querySelector(`#submitmotcle${typeAction}`);

submit.addEventListener('click', () => {
    addMotCle(typeAction);
});


// affichage des mots clés
const monFormulaire = document.querySelector(`#form_${typeAction}`);
const dataActionString = monFormulaire.dataset.action;
const action = JSON.parse(dataActionString);
console.log(action)
action.motcles.split(' ').forEach(mot => {
    let value = document.querySelector(`#letmotcle${typeAction}`);
    value.value = mot
    addMotCle(typeAction)
});