let autocomplete;
function initAutocomplete(){
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("rue"),
        {
            types : ['establishment'],
            componentRestrictions: {'country': ['AU']},
            fields: ['place_id','geometry','name']
        });

    autocomplete.addListener('place_changed',onPlaceChanged);
}

function onPlaceChanged(){

}