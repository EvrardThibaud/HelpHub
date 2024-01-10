let body = document.body;
let cookieModal = document.getElementById("cookie-consent-modal");


function hideCookieModal() {
    cookieModal.style.display = "none";
    body.classList.remove("modal-open");
}
function acceptCookies() {
    hideCookieModal();
    localStorage.setItem("cookieAccepted", "oui");
}

document.addEventListener("DOMContentLoaded", function () {
    let cookieAccepted = localStorage.getItem("cookieAccepted");
    if (cookieAccepted !== "oui") {
        cookieModal.style.display = "block";
        body.classList.add("modal-open"); 
    }
});
