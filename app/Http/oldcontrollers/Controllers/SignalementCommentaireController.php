<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SignalementCommentaire;
use App\Models\Commentaire;
use App\Models\Action;

class SignalementCommentaireController extends Controller
{
    public function add(Request $request)
    {
        if (auth()->check()) {
            // Valider les données du formulaire (ajoutez vos règles de validation selon les besoins)
            $request->validate([
                'contenusignalement' => 'required',
            ]);

            // Créer une nouvelle instance de SignalementCommentaire
            $signalementCommentaire = new SignalementCommentaire();

            // Récupérer l'ID de l'utilisateur à partir de la session (suppose que l'utilisateur est connecté)
            $utilisateurId = auth()->id();

            // Récupérer la date actuelle
            $dateSignalement = now();

            // Remplir les champs avec les données récupérées
            $signalementCommentaire->idcommentaire = $request->input('idcommentaire');
            $signalementCommentaire->idutilisateur = $utilisateurId;
            $signalementCommentaire->datesignalement = $dateSignalement;
            $signalementCommentaire->contenusignalement = $request->input('contenusignalement');

            // Enregistrer le signalement dans la base de données
            $signalementCommentaire->save();

            // Ajouter l'affichage du message dans le script PHP
            $commentaire = Commentaire::find($request->input('idcommentaire'));
            $action = Action::find($commentaire->idaction);
            $message = "Message envoyé!\nID utilisateur du commentaire: {$utilisateurId}\nNom de l'action: {$action->titreaction}\nContenu du motif: {$request->input('contenusignalement')}";
            echo "<script>alert('{$message}');</script>";

            // Rediriger ou     renvoyer une réponse selon vos besoins
            return redirect()->back()->with('message', 'Vous avez signalé ce commentaire.');
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour signaler un commentaire.');
        }
    }
    // public function showMessage(Request $request)
    // {
    //     $utilisateurId = $request->query('utilisateurId');
    //     $actionTitre = $request->query('actionTitre');
    //     $contenuMotif = $request->query('contenuMotif');

    //     // Afficher le message ici ou utiliser une vue spécifique
    //     echo "<script>alert('Message envoyé!\nID utilisateur du commentaire: {$utilisateurId}\nNom de l'action: {$actionTitre}\nContenu du motif: {$contenuMotif}');</script>";
    // }
}
