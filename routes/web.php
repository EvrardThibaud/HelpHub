<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\SignalementCommentaireController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get("/",[ActionController::class, "welcome" ]);

Route::get("/action",[ActionController::class, "one" ]);
Route::get('/action/{id}', [CommentaireController::class, 'show'])->name('action.show');


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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mescoms', [ProfileController::class, 'mescoms'])->name('profile.mescoms');
    Route::get('/administration', [ProfileController::class, 'administration'])->name('profile.administration');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route qui renvoie les suggestions d'adresse
Route::get('/get-address-suggestions', [AddressController::class, 'getAddressSuggestions']);


require __DIR__.'/auth.php';
