<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Like; 

class CommentaireController extends Controller
{

    public function incrementerLikes(Request $request)
    {
        $request->validate([
            'idcommentaire' => 'required|exists:commentaire,idcommentaire',
        ]);

        $commentaireId = $request->input('idcommentaire');
        $commentaire = Commentaire::find($commentaireId);

        if ($commentaire) {
            if (auth()->check()) {
                $user = auth()->user();

                // Assuming you have a 'likes' relationship on the Commentaire model
                $userLiked = $commentaire->like()->where('idutilisateur', $user->idutilisateur)->exists();

                if ($userLiked) {
                    // User has already liked the comment, so unlike it
                    $commentaire->nblikecommentaire--;
                    $commentaire->save();

                    // Replace 'likes' with the actual relationship method
                    $commentaire->like()->where('idutilisateur', $user->idutilisateur)->delete();

                    return redirect()->back()->with('success', 'Like retiré avec succès!');
                } else {
                    // User has not liked the comment, so add like
                    $commentaire->nblikecommentaire++;
                    $commentaire->save();

                    // Replace 'likes' with the actual relationship method
                    $commentaire->like()->create(['idutilisateur' => $user->idutilisateur]);

                    return redirect()->back()->with('success', 'Like ajouté avec succès!');
                }
            } else {
                // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                return redirect()->route('login')->with('error', 'Vous devez être connecté pour effectuer cette action.');
            }
        }

        return redirect()->back()->with('message', 'Commentaire non trouvé.');
    }

    public function signalerCommentaire(Request $request)
    {
        $commentaireId = $request->input('idcommentaire');
        $motif = $request->input('motif');


        $request->validate([
            'idcommentaire' => 'required|exists:commentaires,idcommentaire',
            'motif' => 'required|string|max:255',
        ]);
        $report = new Report([
            'commentaire_id' => $commentaireId,
            'motif' => $motif,
        ]); 

        $report->save();

        return redirect()->route('action.show', ['id' => $commentaire->action_id])
            ->with('message', 'Signalement envoyé avec succès !');
    }
    
    public function addComment(Request $request)
    {
        $request->validate([
            'action_id' => 'required|exists:action,idaction',
            'new_comment' => 'required|string|max:255',
        ]);

        $comment = new Commentaire([    
            'idutilisateur' => auth()->user()->idutilisateur,
            'idaction' => $request->input('action_id'),
            'textecommentaire' => $request->input('new_comment'),
        ]);

        $comment->save();

        return redirect()->back()->with('message', 'Commentaire ajouté avec succès!');
    }
}