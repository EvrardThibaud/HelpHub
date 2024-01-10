let notif = document.querySelector('#notif');
let notificationPage = document.querySelector('#notif_page');

if(notif){

    notif.addEventListener('click', () => {
        notificationPage.classList.toggle("hiddenNotif");
    })
}

