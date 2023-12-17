<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Association;
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


class ThematiqueController extends Controller
{

    public function creerThematique(Request $request): RedirectResponse
    {

        
        $request->validate([
            'libellethematique' => ['required', 'string', 'max:255'],
        ]);
        

        $thematique = Thematique::create([
            'idthematique' => $request->idthematique,
            'libellethematique' => $request->libellethematique
        ]);

        return redirect()->route('profile.ajoutthematique');
    }

}