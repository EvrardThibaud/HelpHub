

let supprimers = document.querySelectorAll('#supprimer');

supprimers.forEach(function(supprimer) {
    supprimer.addEventListener('click', function(){
        let confirmation = document.getElementById('confirmation');
        confirmation.classList.toggle('hide');
        document.body.classList.toggle('no-scroll');
        var baseUrl = "{{ route('profile.supprimeraction', ['id' => '']) }}";

      
        if (!confirmation.classList.contains('hide')) {
            let titre = document.getElementById('letitre');
            
            let actionString = this.dataset.action; 
            let actionObj = JSON.parse(actionString); 
            let idactioninput = document.getElementById('idaction');
            idactioninput.value = actionObj.idaction;
            
            let title = actionObj.titreaction;
            titre.innerHTML = title;
        }

    });
});

let annuler = document.getElementById('annuler');
annuler.addEventListener("click", function(){
    let confirmation = document.getElementById('confirmation');
    confirmation.classList.toggle('hide');
    document.body.classList.toggle('no-scroll');    
})