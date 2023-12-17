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
use App\Models\ThematiqueAction;
use App\Models\ParticipationDon;
use App\Models\Association;
use App\Models\Thematique;
use App\Models\Candidature;
use App\Models\Civilite;
use App\Models\User;

class CandidatureController extends Controller
{
    public function creerCandidature(Request $request)
    {
        $request->validate([
            'civilite' => 'required|not_in:0', // Vérifie que la valeur n'est pas 0 (la valeur vide)
            
        ]);
        

        $candidature = Candidature::create([
            'idaction' => $request->idaction,
            'idetatcandidature' => 1,
            'idutilisateur' => auth()->user()->idutilisateur,
            'informationscandidature' => $request->motivation,
        ]);

        User::where('idutilisateur', auth()->user()->idutilisateur)->update(['idcivilite' => $request->civilite]);
        User::where('idutilisateur', auth()->user()->idutilisateur)->update(['datenaissance' => $request->datenaissance]);

        return redirect()->back()->with('message', 'Candidature ajoutée avec succès!');
    }

    public function formulaireCandidature(Request $request): View
    {
        $id = $request->idaction;
        return view('candidature', [
            'id' => $id,
            'user' => $request->user(),
            'civilites'=>Civilite::All(),
        ]);
    }
    

}
