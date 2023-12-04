
var hearts = document.querySelectorAll(".fa-heart");

hearts.forEach(function (heart) {
    heart.addEventListener('click', function () {
        this.classList.toggle('fa-regular');
        this.classList.toggle('fa-solid');
    });
});