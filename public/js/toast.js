let toastBox = create("div", "", document.body);
toastBox.id = "toastBox";

let emojiValid = "<i class='fa-solid fa-check'></i>"
let emojiError = "<i class='fa-solid fa-triangle-exclamation'></i>"
let emojiInvalid = "<i class='fa-solid fa-circle-exclamation'></i>"

function create(tag, text, container){
    let el = document.createElement(tag)
    el.appendChild(document.createTextNode(text))
    container.appendChild(el)
    return el
}

function createToast(format, texte){

    let toast = create("div", "", toastBox)
    toast.classList.add("toast")
    toast.classList.add(format)
    let firstpart = create("div", "", toast)
    firstpart.classList.add("firstpart")
    let iclose = create("i", "", firstpart)
    iclose.addEventListener("click", function(){
        toast.remove();
    })
    iclose.classList.add("close")
    iclose.classList.add("fa-solid")
    iclose.classList.add("fa-circle-xmark")

    let secondpart = create("div", "", toast)
    secondpart.classList.add("secondpart")
    let iEmoji = create("i", "", secondpart)
    iEmoji.classList.add("fa-solid")
    iEmoji.classList.add("fa-check")
    let finalTexte = "";
    finalTexte = texte; 
    let h2 = create("h2", finalTexte, secondpart)
    setInterval(function(){
        toast.remove()
    },5000)
}