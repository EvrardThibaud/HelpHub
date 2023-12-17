<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\SignalementCommentaireController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IdentiteBancaireController;
use App\Http\Controllers\CarteBancaireController;
use App\Http\Controllers\ActionCreationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ThematiqueController;
use App\Http\Controllers\AuthenticatedSessionController;


use Illuminate\Support\Facades\Route;

Route::get('/get-variables', 'ActionController@getVariables');


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get("/",[ActionController::class, "welcome" ]);

Route::get("/action",[ActionController::class, "one" ]);
// LIKER UNE ACTION
Route::post('/incrementer-likes-action', [ActionController::class, 'incrementerLikesAction'])->name('incrementerLikesAction');
Route::get('/action/{id}', [CommentaireController::class, 'show'])->name('action.show');

Route::post('/action/visible', [ActionController::class, 'rendreInvisible'])->name('action.visible');
Route::post('/action/invisible', [ActionController::class, 'rendreVisible'])->name('action.invisible');


Route::post('/comment/add', [CommentaireController::class, 'addComment'])->name('comment.add');
Route::post('/comment/like', [CommentaireController::class, 'like'])->name('comment.like')->middleware('auth');
Route::post('/incrementer-likes', [CommentaireController::class, 'incrementerLikes'])->name('incrementerLikes');


Route::post('/comment/signalement', [SignalementCommentaireController::class, 'add'])->name('comment.signalement');
Route::get('/comment/signalement/message', [SignalementCommentaireController::class, 'showMessage'])->name('comment.signalement.message');

Route::get("/association",[AssociationController::class, "one" ]);
Route::get('/recherche', [ActionController::class, 'recherche']);

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::get('/contact/confirmation', [ContactController::class, 'confirmation'])->name('contact.confirmation');

Route::get('/action?id={id}', [ActionController::class, 'one'])->name('action.show');

// SIGNALEMENT COMMENTAIRE
Route::post('/action', [SignalementCommentaireController::class, 'add'])->name('action.submit');


Route::get('/politique', function () {
    return view('politique');
})->name("politique");




Route::get('/cgu', function () {
    return view('cgu');
})->name("cgu");

Route::get('/mentions', function () {
    return view('mentions');
})->name("mentions");

Route::get('/persocookies', function () {
    return view('persocookies');
})->name("persocookies");

Route::get('/info-register', function () {
    return view('info_register');
})->name("info_register");

Route::get('/cookies', function () {
    return view('cookies');
})->name("cookies");

Route::get('/damas', function () {
    return view('damas');
})->name("damas");

Route::get('/choix-inscription', function () {
    return view('auth/choix-inscription');
})->name("choix-inscription");

Route::get('/contact', function () {
    return view('contact');
})->name("contact");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/check-session', [SessionController::class, 'checkSession'])->name('check_session');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mescoms', [ProfileController::class, 'mescoms'])->name('profile.mescoms');
    Route::get('/mesinfosbancaire', [ProfileController::class, 'mesinfosbancaire'])->name('profile.mesinfosbancaire');
    Route::get('/actionlikes', [ProfileController::class, 'actionlikes'])->name('profile.actionlikes');
    Route::get('/mesactions', [ProfileController::class, 'mesactions'])->name('profile.mesactions');
    Route::get('/modifaction', [ProfileController::class, 'modifaction'])->name('profile.modifaction');
    Route::get('/demandeactions', [ProfileController::class, 'demandeactions'])->name('profile.demandeactions');
    Route::get('/powerbi', [ProfileController::class, 'powerbi'])->name('profile.powerbi');
    Route::get('/candidatures', [ProfileController::class, 'candidatures'])->name('profile.candidatures');
    Route::post('/acceptersignalement', [SignalementCommentaireController::class, 'acceptersignalement'])->name('profile.acceptersignalement');
    Route::post('/refusersignalement', [SignalementCommentaireController::class, 'refusersignalement'])->name('profile.refusersignalement');
    Route::get('/comsignales', [ProfileController::class, 'comsignales'])->name('profile.comsignales');
    Route::get('/ajoutthematique', [ProfileController::class, 'ajoutthematique'])->name('profile.ajoutthematique');
    Route::get('/actioninvisible', [ProfileController::class, 'actioninvisible'])->name('profile.actioninvisible');
    Route::get('/creeraction', [ProfileController::class, 'creeraction'])->name('profile.creeraction');
    Route::post('/supprimeraction', [ProfileController::class, 'supprimeraction'])->name('profile.supprimeraction');
    Route::get('/administration', [ProfileController::class, 'administration'])->name('profile.administration');
    Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.supprimer');
});

Route::post('/accepteraction/{id}', [ActionCreationController::class, 'accepteraction'])->name('accepteraction');
Route::post('/refuseraction/{id}', [ActionCreationController::class, 'refuseraction'])->name('refuseraction');

Route::post('/creerCandidature', [CandidatureController::class, 'creerCandidature'])->name("creerCandidature");
Route::get('/formulaireCandidature', [CandidatureController::class, 'formulaireCandidature'])->name("formulaireCandidature");

Route::post('/creerbenevolat', [ActionCreationController::class, 'creerbenevolat'])->name('creerbenevolat');
Route::post('/creerdon', [ActionCreationController::class, 'creerdon'])->name('creerdon');
Route::post('/creerinformation', [ActionCreationController::class, 'creerinformation'])->name('creerinformation');
Route::post('/modifbenevolat', [ActionCreationController::class, 'modifbenevolat'])->name('modifbenevolat');
Route::post('/modifdon', [ActionCreationController::class, 'modifdon'])->name('modifdon');
Route::post('/modifinformation', [ActionCreationController::class, 'modifinformation'])->name('modifinformation');


Route::post('/creerthematique', [ThematiqueController::class, 'creerThematique'])->name('creerThematique');


Route::post('/updateinfosbancaire', [IdentiteBancaireController::class, 'updateinfosbancaire'])->name('updateinfosbancaire');
Route::post('/suppinfosbancaire', [IdentiteBancaireController::class, 'suppinfosbancaire'])->name('suppinfosbancaire');
Route::post('/addinfosbancaire', [IdentiteBancaireController::class, 'addinfosbancaire'])->name('addinfosbancaire');

Route::post('/updatecartebancaire', [CarteBancaireController::class, 'updatecartebancaire'])->name('updatecartebancaire');
Route::post('/suppcartebancaire', [CarteBancaireController::class, 'suppcartebancaire'])->name('suppcartebancaire');
Route::post('/addcartebancaire', [CarteBancaireController::class, 'addcartebancaire'])->name('addcartebancaire');


//route qui renvoie les suggestions d'adresse
Route::get('/get-address-suggestions', [AddressController::class, 'getAddressSuggestions']);


require __DIR__.'/auth.php';
