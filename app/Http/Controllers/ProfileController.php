<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Adresse;
use App\Models\Action;
use App\Models\ActionLike;
use App\Models\DemandeDon;
use App\Models\DemandeBenevolat;
use App\Models\Information;
use App\Models\ParticipationBenevolat;
use App\Models\SignalementCommentaire;
use App\Models\ThematiqueAction;
use App\Models\ParticipationDon;
use App\Models\Association;
use App\Models\Thematique;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

    public function actionlikes(Request $request): View
    {
        $id = $request->user()->idutilisateur;

        $likedActions = ActionLike::join('action', 'action_like.idaction', '=', 'action.idaction')
            ->join('association', 'action.idassociation', '=', 'association.idassociation')
            ->where('action_like.idutilisateur', $id)
            ->get(['action.*', 'association.nomassociation']);
    
        return view('profile.actionlikes', [
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

    public function supprimeraction(Request $request): View{
        $id = $request->idaction;
        if (is_numeric($id)) {
            $action = Action::find($id);
    
            if ($action) {
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

        /**
     * Display the admin form
     */
    public function administration(Request $request): View
    {
        return view('profile.administration', [
            'actions'=>Action::all(),
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
