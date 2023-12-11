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

class CandidatureController extends Controller
{
    public function creerCandidature(Request $request): RedirectResponse
    {

        $request->validate([
            'civilite' => ['required', 'string', 'max:50'],
            'datenaissance' => ['required'],
            'informationscandidature' => ['required', 'string', 'max:400'],
        ]);
        

        $candidature = Candidature::create([
            'idaction' => $request->idaction,
            'idutilisateur' => auth()->user()->idutilisateur,
            'civilite' => $request->civilite,
            'datenaissance' => $request->datenaissance,
            'informationscandidature' => $request->informationscandidature,
        ]);

        return redirect()->back()->with('message', 'Candidature ajoutée avec succès!');
    }

    public function formulaireCandidature(Request $request): View
    {
        $id = $request->idaction;
        return view('candidature', [
            'id' => $id
        ]);
    }

}
