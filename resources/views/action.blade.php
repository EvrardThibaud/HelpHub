<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action - {!! e($action->titreaction ?? 'Aucune') !!}</title>
    <link rel="stylesheet" href="{{ asset('css/action.blade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    @include('includes.header')

    @if(session('message'))
    <script>
       // Récupère le message de la session et l'échappe
       //pour son intégration sécurisée en JavaScript
        var message = '{!! e(session('message')) !!}';
        // Appelle la fonction createToast avec le type 
        //'valid' et le message 
        createToast('valid', message);
    </script>
    @endif 

    
    @if($action)
        <div id="titre_div">
            <h1>{!! e($action->titreaction) !!}</h1>
        </div> 
        <main>
            <div id="container_left">
                <div id="action_div">
                    <p id="asso_action">Action proposée par <a href="/association?id={{ $action->idassociation }}">{!! e($action->nomassociation) !!}</a></p>
                    <p id="description_action">{!! e($action->descriptionaction) !!}</p>
                    <p id="date_action">{{ \Carbon\Carbon::parse($action->datepublicationaction)->isoFormat('D MMMM Y', 'Do MMMM Y') }}</p>
                </div>

                <div id="comentaires_div">
                    <h2 id="titrecom">Les commentaires</h2>
                    <div id="add-comment-form">
                        <h3>Ajouter un commentaire</h3>
                        @auth
                            <form action="{{ route('comment.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                                <textarea name="new_comment" placeholder="Votre commentaire." required>{{ old('new_comment') }}</textarea>
                                <button type="submit">Ajouter le commentaire</button>
                            </form>
                        @else
                            <p><a href="\login">Connectez-vous</a> pour ajouter un commentaire.</p>
                        @endauth
                    </div>
                    @if(count($commentaires) > 0)
                        <div id="lescommentaires">
                            
                            @foreach ($commentaires as $commentaire)
                                <div class="commentaire">
                                    <div class="commentaire_user">
                                        @if($commentaire->image)
                                            <img src="{{ $commentaire->image }}"  >
                                        @else
                                            <img src="https://cdn4.iconfinder.com/data/icons/basic-ui-pack-flat-s94-1/64/Basic_UI_Icon_Pack_-_Flat_user-512.png" >
                                        @endif
                                        <div class="column">
                                            
                                        
                                        <h3>
                                            @if ($commentaire->admin)
                                                <span style="color: red;">Administrateur {{ $commentaire->prenomutilisateur }} {{ $commentaire->nomutilisateur }}</span>
                                            @else
                                                {{ $commentaire->prenomutilisateur }} {{ $commentaire->nomutilisateur }}
                                            @endif
                                        </h3>


                                            <p id="date_commentaire">{{ \Carbon\Carbon::parse($commentaire->datecommentaire)->isoFormat('D MMMM Y', 'Do MMMM Y') }}</p>
                                        </div>
                                    </div>
                                    <p>{{ $commentaire->textecommentaire }}</p>
                                    <p id="like_section">
                                        <form id="form_like" action="incrementer-likes" method="POST">
                                            @csrf
                                            <input type="hidden" name="idcommentaire" value="{{ $commentaire->idcommentaire }}">
                                            <button style="all:inherit;" type="submit">
                                            
                                            @php 
                                                $find = false; 
                                            @endphp
                                            @foreach ($commentaire->like as $like)
                                                @if (Auth::user() && $like["idutilisateur"] == Auth::user()->idutilisateur)
                                                    @php 
                                                        $find = true; 
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($find)
                                                <i class="fa-heart fa-solid"></i>
                                            @else
                                                <i class="fa-heart fa-regular"></i>
                                            @endif

                                             {{ $commentaire->nblikecommentaire }}</button>
                                        </form>
                                    </p>
                                    <button id="signaler" onclick="toggleSignalementForm({{ $commentaire->idcommentaire }})">Signaler</button>
                                    <div id="signalement-form-{{ $commentaire->idcommentaire }}" class="signalement-form" style="display: none;">
                                        <form action="{{ route('comment.signalement') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idcommentaire" value="{{ $commentaire->idcommentaire }}">
                                            <textarea name="contenusignalement" placeholder="Raison du signalement" required></textarea>
                                            <button type="submit">Envoyer</button>
                                        </form>
                                    </div>                         
                                </div>
                            @endforeach
                        </div>
                        
                    @else
                        <h4>Aucun commentaires :(</h4>
                    @endif
                </div>

            </div>

            

            <div id="container_right">
                @foreach ($action->images as $img)
                    <img src="/storage/{{$img->media->image}}" alt="">
                @endforeach
                <h3>Plus d'informations</h3>
                <p>Mot clés: {{$action->motcles}}</p>
                <form id="form_like_action" action="incrementer-likes-action" method="POST">
                    @csrf
                    <input type="hidden" name="idaction" value="{{ $action->idaction }}">
                    <button style="all:inherit;" type="submit">
                        @php 
                            $find = false; 
                        @endphp
                        @foreach ($action->likes as $like)
                            @if (Auth::user() && $like["idutilisateur"] == Auth::user()->idutilisateur)
                                @php 
                                    $find = true; 
                                @endphp
                            @endif
                        @endforeach
                        @if ($find)
                            <i class="fa-heart fa-solid"></i>
                        @else
                            <i class="fa-heart fa-regular"></i>
                        @endif
                        {{ count($action->likes) }}
                    </button>
                </form>



                @if ($action->demandebenevolat)
                
                    <p>Adresse: {{$action->demandebenevolat->adresse->villeadresse}} {{$action->demandebenevolat->adresse->codepostaladresse}} ({{$action->demandebenevolat->adresse->numdepartement}})</p>
                    
                    <p>Objectif participation: {{ count($action->demandebenevolat->participation) }} / {{ $action->demandebenevolat->nombreparticipantdb }}</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: {{ (count($action->demandebenevolat->participation) / $action->demandebenevolat->nombreparticipantdb) * 100 }}%;"></div>
                    </div>
                    <p>Compétences requises: {{$action->demandebenevolat->competencesrequisesdb}}</p>
                    <p>Est présentiel ? @if ($action->demandebenevolat->estpresentiuel) ✅ @else ❌ @endif</p>
                    <p>Thématiques:</p>
                    <ul>
                        @foreach ($action->thematiques as $thematique)
                            <li>{{$thematique->thematique->libellethematique}}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('formulaireCandidature') }}" method="get">
                        @csrf
                        <input type="hidden" name="idaction" value="{{$action->idaction}}">
                        <input type="submit" class="bt" value="Participer à l'action">
                    </form>

                    <div id="map"></div>
                    
                    <script>
                        var coordonneeX = {{$action->demandebenevolat->adresse->coordonneex}};
                        var coordonneeY = {{$action->demandebenevolat->adresse->coordonneey}};
                    </script>
                    
                    
                @elseif ($action->demandedon)
                    <form action="" method="POST">
                        @csrf
                        <input type="submit" class="bt" value="Faire un don">
                    </form>

                @endif


                
            

            </div>
            
        </main>
    @else
        <div class="centrer">
            <h1>L'action spécifiée n'existe pas.</h1>
        </div>
    @endif
    
    @include('includes.footer')

<script>
    function toggleSignalementForm(commentaireId, prenom, nom) {
        var form = document.getElementById('signalement-form-' + commentaireId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }

        var motif = document.querySelector('textarea[name="contenusignalement"]').value;
        console.log('Message envoyé!\nMotif: ' + motif + '\nUtilisateur: ' + prenom + ' ' + nom);
        }
</script>
    <script src="{{ asset('js/toggle_like_comm.js') }}" defer></script>
    <script src="{{ asset('js/map.js') }}" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>
</html>
