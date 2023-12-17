<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Commentaire;
use App\Models\IdentiteBancaire;
use App\Models\CarteBancaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Adresse;
use App\Models\Action;
use App\Models\ActionLike;
use App\Models\DemandeDon;
use App\Models\Candidature;
use App\Models\DemandeBenevolat;
use App\Models\Like;
use App\Models\HistoriqueVisu;
use App\Models\Information;
use App\Models\ParticipationBenevolat;
use App\Models\SignalementCommentaire;
use App\Models\ThematiqueAction;
use App\Models\ParticipationDon;
use App\Models\Association;
use App\Models\Thematique;
use App\Models\EtatCandidature;
use App\Models\Civilite;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'civilites' => Civilite::all(),
        ]);
    }

    /**
     * Display the user's commentaires form.
     */
    public function mescoms(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.mescoms', [
            'id'=>$id,
            'commentaires'=>Commentaire::join('action', 'commentaire.idaction', '=', 'action.idaction')->where('idutilisateur', $id)->get()
        ]);
    }

    /*RENVOYER LA PAGE AVEC LES INFOS BANCAIRES DE L'UTILISATEUR */
    public function mesinfosbancaire(Request $request): View
    {
        $id = $request->user()->idutilisateur;
    
        $identiteBancaire = IdentiteBancaire::join('utilisateur', 'utilisateur.idutilisateur', '=', 'identitebancaire.idutilisateur')
            ->where('identitebancaire.idutilisateur', $id)
            ->get();
    
        $carteBancaire = CarteBancaire::join('utilisateur', 'utilisateur.idutilisateur', '=', 'cartebancaire.idutilisateur')
            ->where('cartebancaire.idutilisateur', $id)
            ->get();
    
        // Décrypter les valeurs
        foreach ($identiteBancaire as $info) {
            $info->numerocompte = Crypt::decrypt($info->numerocompte);
            $info->nomcompte = Crypt::decrypt($info->nomcompte);
        }
    
        foreach ($carteBancaire as $carte) {
            $carte->numerocarte = Crypt::decrypt($carte->numerocarte);
            $carte->dateexpiration = Crypt::decrypt($carte->dateexpiration);
            $carte->cryptogramme = Crypt::decrypt($carte->cryptogramme);
            $carte->nomcarte = Crypt::decrypt($carte->nomcarte);
            // Assurez-vous d'ajuster les noms des colonnes en fonction de votre modèle de base de données
        }
    
        return view('profile.mesinfosbancaire', [
            'id' => $id,
            'identite_bancaire' => $identiteBancaire,
            'carte_bancaire' => $carteBancaire,
        ]);
    }
    

    


    public function actionlikes(Request $request): View
    {
        $id = $request->user()->idutilisateur;

        $likedActions = Action::join('association', 'action.idassociation', '=', 'association.idassociation')
            ->leftJoin('action_like', 'action.idaction', '=', 'action_like.idaction')
            ->groupBy('action.idaction')
            ->withCount('likes')  // Utilisez withCount pour compter les likes
            ->where('action_like.idutilisateur', $id)
            ->get(['action.*', 'association.nomassociation']);

        return view('profile.mesactionlikees', [
            'id' => $id,
            'likedActions' => $likedActions,
        ]);
    }

    

    public function mesactions(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.mesactions', [
            'id'=>$id,
            'actionlike'=>ActionLike::all(),
            'associations'=>Association::all() ,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>DemandeBenevolat::all(),
            'demandedon'=>DemandeDon::all(),
            'actionlike'=>ActionLike::all(),
        ]);
    }

    function modifaction(Request $request): View
    {
        $id = $request->input('id');
        return view('profile.modifaction', [
            'id'=>$id,
            'action'=>Action::find($id),
            'thematiques'=>Thematique::all(),
        ]);
    }
    function powerbi(Request $request): View
    {
        return view('powerbi', [
        ]);
    }
    function modifactionfinal(Request $request, $id)
    {
        $action = Action::find($id);
    
        if ($action) {
            //modif
            $action->save();
            return redirect()->back()->with('message', "Vous avez modifié cette action.");
        } else {
            return redirect()->back()->with('message', 'Erreur dans la modification.');
        }
    }



    public function supprimeraction(Request $request): View{
        $id = $request->idaction;
        if (is_numeric($id)) {
            $action = Action::find($id);
    
            if ($action) {
                HistoriqueVisu::where('idaction', $id)->delete();
                ThematiqueAction::where('idaction', $id)->delete();
                DemandeBenevolat::where('idaction', $id)->delete();
                DemandeDon::where('idaction', $id)->delete();
                Information::where('idaction', $id)->delete();
                ActionLike::where('idaction', $id)->delete();
                Action::where('idaction', $id)->delete();
            } 
        }
        return view('profile.mesactions', [
            'id'=>$id,
            'actionlike'=>ActionLike::all(),
            'associations'=>Association::all() ,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>DemandeBenevolat::all(),
            'demandedon'=>DemandeDon::all(),
            'actionlike'=>ActionLike::all(),
        ]);
    }

    public function creeraction(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.creeraction', [
            'id'=>$id,
            'thematiques'=>Thematique::all(),
        ]);
    }
    
    public function demandeactions(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.demandeactions', [
            'id'=>$id,
            'actions'=>Action::where('valideparservice', false)->get(),

        ]);
    }

    public function comsignales(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.comsignales', [
            'id'=>$id,
            'commentaires'=>SignalementCommentaire::all(),

        ]);
    }


    public function ajoutthematique(Request $request): View
    {
        return view('profile.ajoutthematique', [
            'thematiques'=>Thematique::all(),

        ]);
    }

    public function actioninvisible(Request $request): View
    {
        $actions = Action::orderBy('datepublicationaction', 'desc')->get();
        
        return view('profile.actioninvisible', [
            'actions'=>$actions,
        ]);
    }

        /**
     * Display the admin form
     */
    public function administration(Request $request): View
    {
        return view('profile.administration', [
            'actions'=>Action::all(),
        ]);
    }

    public function candidatures(Request $request): View
    {
        $id = $request->user()->idutilisateur;
        return view('profile.mescandidatures', [
            'candidatures'=>Candidature::where('idutilisateur', $id)->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());


        // Vérifier si l'adresse existe pour le code postal donné
        $adresse = Adresse::where('codepostaladresse', $request->codepostaladresse)->first();

        if (!$adresse) {
            // Si l'adresse n'existe pas, créez-la
            $adresse = Adresse::create([
                'codepostaladresse' => $request->codepostaladresse,
                'villeadresse' => $request->rue, // Assurez-vous d'avoir la valeur de la ville dans la requête
                'numdepartement' => substr($request->codepostaladresse, 0, 2), // Adapter selon le format de vos codes postaux
            ]);
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->adresse()->associate($adresse);
        
        $request->user()->save();

        
        
        return Redirect::route('profile.edit')->with([
            'status' => 'profile-updated',
        ]);

        //return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        HistoriqueVisu::where('idutilisateur', $user->idutilisateur)->delete();
        Candidature::where('idutilisateur', $user->idutilisateur)->delete();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
