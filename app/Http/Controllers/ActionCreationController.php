<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\LesAssociation;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use App\Models\ThematiqueAction;
use App\Models\ParticipationBenevolat;
use App\Models\ParticipationDon;
use App\Models\DemandeBenevolat;
use App\Models\DemandeDon;
use App\Models\Information;
use App\Models\Thematique;
use App\Models\Adresse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class ActionCreationController extends Controller
{


    public function creerbenevolat(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:255'],

            'competencesrequisesdb' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:100'],
            'codepostaladresse' => ['required', 'int',"digits:5"],
            'nombreparticipantdb' => ['required', 'integer'],
        ]);
        
        // Vérifier si l'adresse existe pour le code postal donné
        $adresse = Adresse::where('codepostaladresse', $request->codepostaladresse)->first();

        if (!$adresse) {
            // Si l'adresse n'existe pas, créez-la
            $adresse = Adresse::create([
                'codepostaladresse' => $request->codepostaladresse,
                'villeadresse' => $request->villeadresse, // Assurez-vous d'avoir la valeur de la ville dans la requête
                'numdepartement' => substr($request->codepostaladresse, 0, 2), // Adapter selon le format de vos codes postaux
            ]);
        }

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
        ]);

        $demandebenevolat = DemandeBenevolat::create([
            'idaction' => $action->idaction,
            'codepostaladresse' => $request->codepostaladresse,
            'competencesrequisesdb' => $request->competencesrequisesdb,
            'nombreparticipantdb' => $request->nombreparticipantdb,
            'estpresentieldb' => $request->estpresentieldb,
        ]);

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }
        $demandebenevolat->adresse()->associate($adresse);
        $demandebenevolat->save();


        return redirect()->route('profile.mesactions');
    }

    public function creerdon(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:255'],

            'ribdon' => ['required', 'string', 'max:255'],
            'objectifdon' => ['required', 'integer'],
        ]);
        

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
        ]);

        $demandedon = DemandeDon::create([
            'idaction' => $action->idaction,
            'ribdon' => $request->ribdon,
            'objectifdon' => $request->objectifdon,
            'argentrecoltedon' => 0,
            'avantagefiscal' => $request->avantagefiscal,
        ]);

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }

        return redirect()->route('profile.mesactions');
    }

    public function creerinformation(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:255'],
        ]);
        

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
        ]);

        $demandeinformation = Information::create([
            'idaction' => $action->idaction,
        ]);

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }

        return redirect()->route('profile.mesactions');
    }
}