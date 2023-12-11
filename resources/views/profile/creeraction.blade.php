@section('title', 'Créer une action - HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/creeraction.blade.css">

    <div id="page">
        <h1>Créer une action</h1>
        <div id="choisir_type_action">
            <p>Choisir le type d'action:</p>
            <h3 class="type_action active">Bénévolat</h3>    
            <h3 class="type_action">Don</h3>    
            <h3 class="type_action">Information</h3>    
        </div>
        <div id="content">
            <div id="form-Bénévolat">
                <h2>Action de bénévolat</h2>
                <form id="form_benevolat" method="POST" action="{{ route('creerbenevolat') }}">
                    @csrf


                    <div id="form_input">
                        <!-- Titre ACtion -->
                        <div class="input_div">
                            <x-input-label for="titreaction" :value="__('Votre titre :')" />
                            <x-text-input id="titreaction" class="" type="text" name="titreaction" :value="old('titreaction')" required autofocus autocomplete="titreaction"/>
                            <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                        </div>
                
                
                        <!-- Description -->
                        <div class="input_div">
                            <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                            <x-text-input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" :value="old('descriptionaction')" required autocomplete="descriptionaction"/>
                            <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                        </div>
                

                        <!-- Adresse -->
                        <div class="input_div">
                            <x-input-label for="adresse" :value="__('Votre adresse :')" />
                            <x-text-input id="adresse" class="" type="text" placeholder="9 rue de l'arc en ciel" name="rue" :value="old('rue')" required autocomplete="rue"/>
                            <input type="text" name="villeadresse" style="display: none;" id="villeadresse" value="">
                            <x-input-error :messages="$errors->get('rue')" class="alert" />
                            
                                <ul id="les_adresses">

                                </ul>
                        </div>

                        <!-- coordonne x -->
                        <div class="input_div" style="display: none;">
                            <input type="text" name="coordonnex" id="coordonnex" value="">
                        </div>

                        <!-- coordonne y -->
                        <div class="input_div" style="display: none;">
                            <input type="text" name="coordonney" id="coordonney" value="">
                        </div>
                
                        <!-- Code postal -->
                        <div class="input_div">
                            <x-input-label for="codepostaladresse" :value="__('Votre code postal :')" />
                            <x-text-input id="codepostaladresse" class="" type="text" name="codepostaladresse" :value="old('codepostaladresse')" placeholder="74000" required />
                            <x-input-error :messages="$errors->get('codepostaladresse')" class="alert" />
                        </div>
                        <!-- est présentielr -->
                        <div id="newsletter_div">
                            <label for="estpresentieldb" class="">
                                <input type="checkbox" @if(old('estpresentieldb')) checked @endif id="estpresentieldb" name="estpresentieldb" class="form-checkbox">
                                <span class="ml-2 text-sm">{{ __('Est en présentiel ?') }}</span>
                            </label>
                        </div>

                        <!-- Compétences requises -->
                        <div class="input_div">
                            <x-input-label for="competencesrequisesdb" :value="__('Compétences requises :')" />
                            <x-text-input id="competencesrequisesdb" class="" type="text" name="competencesrequisesdb" :value="old('competencesrequisesdb')" value="Aucune" required autofocus onclick="clearDefaultText()" onblur="resetDefaultText()"  autocomplete="competencesrequisesdb"/>
                            <x-input-error :messages="$errors->get('competencesrequisesdb')" class="alert" />
                        </div>

                        <!-- Objectif participant -->
                        <div class="input_div">
                            <x-input-label for="nombreparticipantdb" :value="__('Objectif de participant :')" />
                            <x-text-input id="nombreparticipantdb" class="" type="text" name="nombreparticipantdb" :value="old('nombreparticipantdb')" placeholder="100" required />
                            <x-input-error :messages="$errors->get('nombreparticipantdb')" class="alert" />
                        </div>

                        <!-- Thematiques -->
                        <div id="newsletter_div">
                            <div id="them_benevolat">
                                @foreach ($thematiques as $thematique)
                                    <label for="thematique_{{$thematique->idthematique}}" class="">
                                        <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                        @if(old("thematique_{$thematique->idthematique}")) checked @endif>
                                        <span class="ml-2 text-sm">{{$thematique->libellethematique}}</span>
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="form_over">
                        <div id="form_login_submit">
                            
                            <x-primary-button id="submit_button">
                                {{ __('Envoyer la demande') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="form-Don" class="hide">
                <h2>Action de don</h2>
                <form id="form_don" method="POST" action="{{ route('creerdon') }}">
                    @csrf


                    <div id="form_input">
                        <!-- Titre ACtion -->
                        <div class="input_div">
                            <x-input-label for="titreaction" :value="__('Votre titre :')" />
                            <x-text-input id="titreaction" class="" type="text" name="titreaction" :value="old('titreaction')" required autofocus autocomplete="titreaction"/>
                            <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                        </div>
                
                
                        <!-- Description Address -->
                        <div class="input_div">
                            <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                            <x-text-input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" :value="old('descriptionaction')" required autocomplete="descriptionaction"/>
                            <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                        </div>
                



                        <!-- RIB -->
                        <div class="input_div">
                            <x-input-label for="ribdon" :value="__('RIB de l\'association :')" />
                            <x-text-input id="ribdon" class="" type="text" name="ribdon" :value="old('ribdon')" required autofocus autocomplete="ribdon"/>
                            <x-input-error :messages="$errors->get('ribdon')" class="alert" />
                        </div>

                        <!-- avantage fiscal -->
                        <div id="newsletter_div">
                            <label for="avantagefiscal" class="">
                                <input type="checkbox" @if(old('avantagefiscal')) checked @endif id="avantagefiscal" name="avantagefiscal" class="form-checkbox">
                                <span class="ml-2 text-sm">{{ __('Avantage fiscal ?') }}</span>
                            </label>
                        </div>
                        <!-- Objectif don -->
                        <div class="input_div">
                            <x-input-label for="objectifdon" :value="__('Objectif de don (€) :')" />
                            <x-text-input id="objectifdon" class="" type="text" name="objectifdon" :value="old('objectifdon')" placeholder="100" required />
                            <x-input-error :messages="$errors->get('objectifdon')" class="alert" />
                        </div>
                        <!-- Thematiques -->
                        <div id="newsletter_div">
                            <div id="them_don">

                                @foreach ($thematiques as $thematique)
                                <label for="thematique_{{$thematique->idthematique}}" class="">
                                    <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                    @if(old("thematique_{$thematique->idthematique}")) checked @endif>
                                    <span class="ml-2 text-sm">{{$thematique->libellethematique}}</span>
                                </label>
                                <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="form_over">
                        <div id="form_login_submit">
                            <x-primary-button id="submit_button">
                                {{ __('Envoyer la demande') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>


            <div id="form-Information" class="hide">
                <h2>Action de information</h2>
                <form id="form_information" method="POST" action="{{ route('creerinformation') }}">
                    @csrf


                    <div id="form_input">
                        <!-- Titre ACtion -->
                        <div class="input_div">
                            <x-input-label for="titreaction" :value="__('Votre titre :')" />
                            <x-text-input id="titreaction" class="" type="text" name="titreaction" :value="old('titreaction')" required autofocus autocomplete="titreaction"/>
                            <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                        </div>
                
                
                        <!-- Description Address -->
                        <div class="input_div">
                            <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                            <x-text-input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" :value="old('descriptionaction')" required autocomplete="descriptionaction"/>
                            <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                        </div>


                        <!-- Thematiques -->
                        <div id="newsletter_div">
                            <div id="them_information">
                                @foreach ($thematiques as $thematique)
                                    <label for="thematique_{{$thematique->idthematique}}" class="">
                                        <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                        @if(old("thematique_{$thematique->idthematique}")) checked @endif>
                                        <span class="ml-2 text-sm">{{$thematique->libellethematique}}</span>
                                    </label>
                                    <br>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div id="form_over">
                        <div id="form_login_submit">
                            <x-primary-button id="submit_button">
                                {{ __('Envoyer la demande') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/creeraction.blade.js" defer></script>
    
</x-app-layout>