<style>
        .cache {
            display: none;
        }
</style>
<section class="">
    <header>
        <h1>
            {{ __('Supprimer votre compte et vos données personnelles') }}
        </h1>
        <p>
            {{ __('Une fois votre compte supprimé, toutes les actions et commentaires liés à celui-ci seront supprimés.') }}
        </p>
    </header>
    
    <div class="input_div">
        <div id="confirmation" class="cache">
                <p>
                    {{ __('Êtes-vous sur de vouloir Supprimer votre compte ?') }}
                </p>
        
                <form action="{{ route('profile.supprimer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="idutilisateur" value="{{ Auth::user()->idutilisateur }}">
                    <button id="submit_button" style="background-color: #c43e3e" type="submit">Confirmer la supression</button>
                </form>
        </div>

        <x-danger-button class="" id="boutonSuppr">
        </x-danger-button>
    </div>

</section>

<script>
    let bouton = document.getElementById('boutonSuppr');
    bouton.textContent = "Supprimer le compte";
    let confirmation = document.getElementById('confirmation');

    bouton.addEventListener('click', function(){
        confirmation.classList.toggle('cache')
        if (bouton.textContent === "Supprimer le compte") {
            bouton.textContent = "Annuler la suppression";
        } else {
            bouton.textContent = "Supprimer le compte";
        }
    })
</script>