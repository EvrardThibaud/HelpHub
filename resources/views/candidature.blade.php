@include('includes.header')
<link rel="stylesheet" href="css/candidature.blade.css">
<div id="content">

    @if(session('message'))
    <div class="message">
        {{ session('message') }}
    </div>
    @endif

        <div id="info">

            <h1>Inscription à une Action Bénévole</h1>

            <p>
                Remplissez le formulaire ci-dessous pour vous inscrire à notre action bénévole.
            </p>

            <p>Les champs marqués d'un astérisque (*) sont obligatoires</p>

        </div>

        <form action="{{ route('creerCandidature') }}" method="post">
        @csrf
        
            <input type="hidden" value="{{ $id }}" name="idaction">

            <div class="input_div">
            <label for="civilite">Civilité</label>
                <select name="civilite" >
                <option value="" disabled selected>Renseigner ce champ</option>

                    @foreach ($civilites as $civilite)
                        @if($civilite->idcivilite != 1)
                            <option value="{{ $civilite->idcivilite }}" {{ $user->idcivilite == $civilite->idcivilite ? 'selected' : '' }}>
                                {{ $civilite->libellecivilite }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('civilite')" class="alert" />
            </div>


            <div class="input_div">
                <label for="datenaissance">Date de Naissance</label>
                <input type="date" id="datenaissance" name="datenaissance" value="{{ $user->datenaissance ?? '' }}" required>
                <x-input-error :messages="$errors->get('date')" class="alert" />
            </div>

           

            <div class="input_div">
                <label for="motivation">Motivation</label>
                <textarea name="motivation" required></textarea>
                <x-input-error :messages="$errors->get('motivation')" class="alert" />
            </div>

            <input type="submit" id="submit_button" value="S'inscrire">
        </form>

        
    
</div>
@include('includes.footer')