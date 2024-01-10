@section('title', "Modification d'action - HelpHub")
<link rel="stylesheet" href="css/dashboard/creeraction.blade.css">

<x-app-layout>

    <div id="page">
        <h1>Modifier une action</h1>
        <div id="content">
            @if ($action->demandebenevolat)
                <script>
                    var typeAction = "benevolat";
                </script>
            
                <div id="form-Bénévolat">
                    <h2>Action de bénévolat</h2>
                    <form clas="form_creation" id="form_benevolat" method="POST" action="{{ route('modifbenevolat') }}" data-action="{{$action}}">
                        @csrf

                        <input name="idaction" type="hidden" value="{{$action->idaction}}">
                        <div id="form_input">
                            <!-- Titre ACtion -->
                            <div class="input_div">
                                <x-input-label for="titreaction" :value="__('Votre titre :')" />
                                <input id="titreaction" class="" type="text" name="titreaction" value="{{ $action->titreaction }}" required autofocus autocomplete="titreaction">

                                <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                            </div>
                    
                    
                            <!-- Description -->
                            <div class="input_div">
                                <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                                <input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" value="{{$action->descriptionaction}}" required autocomplete="descriptionaction"/>
                                
                                <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                            </div>
                    

                            <!-- Adresse -->
                            <div class="input_div">
                                <x-input-label for="adresse" :value="__('Votre adresse :')" />
                                <input id="adresse" class="" type="text" placeholder="9 rue de l'arc en ciel" name="rue" value="{{$action->demandebenevolat->adresse->villeadresse}}" required autocomplete="rue"/>
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
                                <input id="codepostaladresse" class="" type="text" name="codepostaladresse" value="{{$action->demandebenevolat->codepostaladresse}}" placeholder="74000" required />
                                <x-input-error :messages="$errors->get('codepostaladresse')" class="alert" />
                            </div>
                            <!-- est présentielr -->
                            <div id="newsletter_div">
                                <label for="estpresentieldb" class="">
                                    <input type="checkbox" @if($action->demandebenevolat->estpresentieldb) checked @endif id="estpresentieldb" name="estpresentieldb" class="form-checkbox">
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
                                <input id="nombreparticipantdb" class="" type="text" name="nombreparticipantdb" value="{{$action->demandebenevolat->nombreparticipantdb}}" placeholder="100" required />
                                <x-input-error :messages="$errors->get('nombreparticipantdb')" class="alert" />
                            </div>

    
                            <!-- Mot cles -->
                            <div class="input_div">
                                <x-input-label for="motcles" :value="__('Mot clés :')" />
                                <x-text-input id="motclesbenevolat" class="" type="hidden" name="motcles" :value="old('motcles')" required autofocus autocomplete="motcles"/>
                                <div id="lesmotclesbenevolat" class="lesmotcles">
                                    <script>
                                       
                                    </script>
                                </div>
                                <div id="formbenevolatmotcle" class="flex">
                                    <input placeholder="Mot clé" id="letmotclebenevolat" type="text">
                                    <p id="submitmotclebenevolat" class="boutonsubmitmotcle"  type="submit">+</p>
                                </div>
                                <x-input-error :messages="$errors->get('motcles')" class="alert" />
                            </div>
                            
                            <!-- Thematiques -->
                            <div id="newsletter_div">
                                <div id="them_benevolat">
                                    @foreach ($thematiques as $thematique)
                                        @php $found = false @endphp
                                        <label for="thematique_{{$thematique->idthematique}}" class="">
                                            <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                            @foreach ($action->thematiques as $them)
                                                @if($them->idthematique == $thematique->idthematique)
                                                    @php $found = true; @endphp
                                                @endif
                                            @endforeach
                                            
                                            @if($found) checked @endif
                                            >
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
                                    {{ __("Modifer l'action") }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            @elseif ($action->demandedon)
                <script>
                    var typeAction = "don";
                </script>
                <div id="form-Don">
                    <h2>Action de don</h2>
                    <form class="form_creation" id="form_don" method="POST" action="{{ route('modifdon') }}" data-action="{{$action}}">
                        @csrf

                        <input name="idaction" type="hidden" value="{{$action->idaction}}">
                        <div id="form_input">
                            <!-- Titre ACtion -->
                            <div class="input_div">
                                <x-input-label for="titreaction" :value="__('Votre titre :')" />
                                <input id="titreaction" class="" type="text" name="titreaction" value="{{$action->titreaction}}" required autofocus autocomplete="titreaction"/>
                                <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                            </div>
                    
                    
                            <!-- Description Address -->
                            <div class="input_div">
                                <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                                <input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" value="{{$action->descriptionaction}}" required autocomplete="descriptionaction"/>
                                <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                            </div>
                    



                            <!-- RIB -->
                            <div class="input_div">
                                <x-input-label for="ribdon" :value="__('RIB de l\'association :')" />
                                <input id="ribdon" class="" type="text" name="ribdon" value="{{$action->demandedon->ribdon}}" required autofocus autocomplete="ribdon"/>
                                <x-input-error :messages="$errors->get('ribdon')" class="alert" />
                            </div>

                            <!-- avantage fiscal -->
                            <div id="newsletter_div">
                                <label for="avantagefiscal" class="">
                                    <input type="checkbox" @if($action->demandedon->avantagefiscal) checked @endif id="avantagefiscal" name="avantagefiscal" class="form-checkbox">
                                    <span class="ml-2 text-sm">{{ __('Avantage fiscal ?') }}</span>
                                </label>
                            </div>
                            <!-- Objectif don -->
                            <div class="input_div">
                                <x-input-label for="objectifdon" :value="__('Objectif de don (€) :')" />
                                <input id="objectifdon" class="" type="text" name="objectifdon" value="{{$action->demandedon->objectifdon}}" placeholder="100" required />
                                <x-input-error :messages="$errors->get('objectifdon')" class="alert" />
                            </div>
   

                            <!-- Mot cles -->
                            <div class="input_div">
                                <x-input-label for="motcles" :value="__('Mot clés :')" />
                                <x-text-input id="motclesdon" class="" type="hidden" name="motcles" :value="old('motcles')" required autofocus autocomplete="motcles"/>
                                <div id="lesmotclesdon" class="lesmotcles">
                                
                                </div>
                                <div id="formdonmotcle" class="flex">
                                    <input placeholder="Mot clé" id="letmotcledon" type="text">
                                    <p id="submitmotcledon" class="boutonsubmitmotcle" type="submit">+</p>
                                </div>
                                <x-input-error :messages="$errors->get('motcles')" class="alert" />
                            </div>
                            <!-- Thematiques -->
                            <div id="newsletter_div">
                                <div id="them_benevolat">
                                    @foreach ($thematiques as $thematique)
                                        @php $found = false @endphp
                                        <label for="thematique_{{$thematique->idthematique}}" class="">
                                            <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                            @foreach ($action->thematiques as $them)
                                                @if($them->idthematique == $thematique->idthematique)
                                                    @php $found = true; @endphp
                                                @endif
                                            @endforeach
                                            
                                            @if($found) checked @endif
                                            >
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
                                    {{ __("Modifer l'action") }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>

            @else
                <script>
                    var typeAction = "information";
                </script>
                <div id="form-Information">
                    <h2>Action de information</h2>
                    <form class="form_creation" id="form_information" method="POST" action="{{ route('modifinformation') }}" data-action="{{$action}}">
                        @csrf

                        <input name="idaction" type="hidden" value="{{$action->idaction}}">
                        <div id="form_input">
                            <!-- Titre ACtion -->
                            <div class="input_div">
                                <x-input-label for="titreaction" :value="__('Votre titre :')" />
                                <input id="titreaction" class="" type="text" name="titreaction" value="{{$action->titreaction}}" required autofocus autocomplete="titreaction"/>
                                <x-input-error :messages="$errors->get('titreaction')" class="alert" />
                            </div>
                    
                    
                            <!-- Description Address -->
                            <div class="input_div">
                                <x-input-label for="descriptionaction" :value="__('Votre description :')" />
                                <input id="descriptionaction" class="" type="descriptionaction" name="descriptionaction" value="{{$action->descriptionaction}}" required autocomplete="descriptionaction"/>
                                <x-input-error :messages="$errors->get('descriptionaction')" class="alert" />
                            </div>



                            <!-- Mot cles -->
                            <div class="input_div">
                                <x-input-label for="motcles" :value="__('Mot clés :')" />
                                <x-text-input id="motclesinformation" class="" type="hidden" name="motcles" :value="old('motcles')" required autofocus autocomplete="motcles"/>
                                <div id="lesmotclesinformation" class="lesmotcles">
                                
                                </div>
                                <div id="forminformationmotcle" class="flex">
                                    <input placeholder="Mot clé" id="letmotcleinformation" type="text">
                                    <p id="submitmotcleinformation" class="boutonsubmitmotcle"  type="submit">+</p>
                                </div>
                                <x-input-error :messages="$errors->get('motcles')" class="alert" />
                            </div>

                            <!-- Thematiques -->
                            <div id="newsletter_div">
                                <div id="them_benevolat">
                                    @foreach ($thematiques as $thematique)
                                        @php $found = false @endphp
                                        <label for="thematique_{{$thematique->idthematique}}" class="">
                                            <input type="checkbox" id="thematique_{{$thematique->idthematique}}" name="thematique_{{$thematique->idthematique}}" class="form-checkbox"
                                            @foreach ($action->thematiques as $them)
                                                @if($them->idthematique == $thematique->idthematique)
                                                    @php $found = true; @endphp
                                                @endif
                                            @endforeach
                                            
                                            @if($found) checked @endif
                                            >
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
                                    {{ __("Modifer l'action") }}    
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <script src="js/modifaction.blade.js" defer></script>

</x-app-layout>

