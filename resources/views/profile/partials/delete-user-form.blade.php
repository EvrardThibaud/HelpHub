<style>
        .cache {
            display: none;
        }
</style>
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Supprimer votre compte et vos données personnelles') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes les actions et commentaires liés à celui-ci seront supprimés.') }}
        </p>
    </header>

    <x-danger-button class="ms-3" id="boutonSuppr">
                    <p id="text_change">Supprimer le compte</p>
    </x-danger-button>

    <div id="confirmation" class="cache">
        <p>
            {{ __('Êtes-vous sur de vouloir Supprimer votre compte ?') }}
        </p>

        <form action="{{ route('profile.supprimer') }}" method="POST">
            @csrf
            <input type="hidden" name="idutilisateur" value="{{ Auth::user()->idutilisateur }}">
            <button type="submit" style=" background-color: grey;">Confirmer</button>
        </form>
    </div>
</section>

<script>
    let bouton = document.getElementById('boutonSuppr');
    let confirmation = document.getElementById('confirmation');
    let textChange = document.getElementById('text_change');

    bouton.addEventListener('click', function(){
        confirmation.classList.toggle('cache')
        if (textChange.textContent === "Supprimer le compte") {
            textChange.textContent = "Annuler";
        } else {
            textChange.textContent = "Supprimer le compte";
        }
    })
</script>