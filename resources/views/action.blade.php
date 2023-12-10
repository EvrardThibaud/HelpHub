<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action - {{ $action->titreaction ?? 'Aucune' }}</title>
    <link rel="stylesheet" href="{{ asset('css/action.blade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

</head>
<body>
    @include('includes.header')

    @if(session('message'))
    <div class="message">
        {{ session('message') }}
    </div>
    @endif
    
    @if($action)
        <div id="titre_div">
            <h1>{{ $action->titreaction }}</h1>
        </div> 
        <div id="lesimages" class="carousel">
            <div class="carousel-container">
                <img src="https://www.bourdet-avocat.fr/wp-inside/uploads/2020/10/aide-par-les-proches-dans-les-actes-de-la-vie-courante-25.10.2020.jpg" alt="">
                <img src="https://in-terre-actif.com/2010/uploads/RITAPosts/tiny_mce/child-774063_960_720.jpg" alt="">
                <img src="https://www.medecinsdumonde.org/app/uploads/2022/02/benevolat-medecins-du-monde.jpg" alt="">
            </div>
            <button class="prev" onclick="prevSlide()">&#10094;</button>
            <button class="next" onclick="nextSlide()">&#10095;</button>
        </div>
        <main>
            <div id="container_left">
                <div id="action_div">
                    <p id="asso_action">Action proposée par <a href="/association?id={{ $action->idassociation }}">{{ $action->nomassociation }}</a> </p>
                    <p id="description_action">{{ $action->descriptionaction }}</p>
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
                                <textarea name="new_comment" placeholder="Votre commentaire." required></textarea>
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
                                            <h3>{{ $commentaire->prenomutilisateur }} {{ $commentaire->nomutilisateur }}</h3>
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

                <!-- teste github 1 2 1 2 ca marche -->
            </div>

            

            <div id="container_right">
                <h3>Plus d'informations</h3>
                

                @if(auth()->check())
                    <form action="{{ route('participer') }}" method="post">
                        @csrf
                        <input type="hidden" name="action_id" value="{{ $action->idaction }}">
                        <input type="submit" class="bt" value="Participer">
                    </form>
                @else
                    <p>Connectez-vous pour participer à cette action bénévole.</p>
                    <a href="{{ route('login') }}" class="bt">Se connecter</a>
                @endif          
                
                @php 
                    $actionId = $action->idaction; 
                    $countParticipationDon = 0;
                    $countParticipationBenevol = 0;
                    $nbLike = 0
                @endphp
                

                @foreach($actionlike as $like)
                    @if($like['idaction'] == $actionId)
                        @php $nbLike++; @endphp
                    @endif
                @endforeach   

                @foreach($participationdon as $item)
                    @if($item['idaction'] == $actionId)
                        @php $countParticipationDon++; @endphp
                    @endif
                @endforeach
                
                @foreach($participationbenevolat as $item)
                    @if($item['idaction'] == $actionId)
                        @php $countParticipationBenevol++; @endphp
                    @endif
                @endforeach

                
                
                @if($countParticipationDon > 0)
                    <button class="bt">
                        <a >Faire un don</a>
                    </button>    
                @elseif($countParticipationBenevol > 0)
                <div id="map"></div>
                
                @foreach($demandebenevolat as $demande)
                    {{ $demande->codepostaladresse }}
                @endforeach
                <form action="{{ route('participer') }}" method="POST">
                    @csrf
                    <input type="submit" class="bt" value="Participer">
                </form>
                @else
                    <!-- <li>Information</li> -->

                @endif

                <p>Nombre de like: {{$nbLike}}</p>

                <!-- bene: {{$demandebenevolat}}
                don: {{$demandedon}}
                info: {{$information}} -->

            </div>
            
        </main>
    @else
        <h1>L'action spécifiée n'existe pas.</h1>
    @endif

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
<script>
    // ne pas recharger la  page
    // var form_like = document.querySelector('#form_like');
    // form_like.addEventListener("submit", function(e){
    //     e.preventDefault();
    // });
    //----------------------------
let slideIndex = 0;
let timer;

function showSlides() {
  const slides = document.querySelectorAll('.carousel-container img');
  if (slides.length > 1) {
    slideIndex++;
    if (slideIndex >= slides.length) {
      slideIndex = 0;
    }
    const offset = -100 * slideIndex;
    document.querySelector('.carousel-container').style.transform = `translateX(${offset}vw)`;
    startTimer(); // Redémarre le timer à chaque transition
  }
}

function prevSlide() {
  slideIndex--;
  if (slideIndex < 0) {
    slideIndex = document.querySelectorAll('.carousel-container img').length - 1;
  }
  const offset = -100 * slideIndex;
  document.querySelector('.carousel-container').style.transform = `translateX(${offset}vw)`;
  resetTimer(); // Réinitialise le timer lors du clic sur le bouton précédent
}

function nextSlide() {
  slideIndex++;
  if (slideIndex >= document.querySelectorAll('.carousel-container img').length) {
    slideIndex = 0;
  }
  const offset = -100 * slideIndex;
  document.querySelector('.carousel-container').style.transform = `translateX(${offset}vw)`;
  resetTimer(); // Réinitialise le timer lors du clic sur le bouton suivant
}

function startTimer() {
  clearInterval(timer);
  timer = setInterval(showSlides, 5000); // Change d'image toutes les 2 secondes (ajuste selon tes besoins)
}

function resetTimer() {
  clearInterval(timer);
  startTimer();
}

startTimer(); // Démarre le carousel au chargement de la page

</script>