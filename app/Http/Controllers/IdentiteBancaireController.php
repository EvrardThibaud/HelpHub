<?php
namespace App\Http\Controllers;



use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\IdentiteBancaire;
use Illuminate\Http\RedirectResponse;

class IdentiteBancaireController extends Controller
{
    public function updateinfosbancaire(Request $request) : RedirectResponse
    {
        $request->validate([
            'numerocompte' => ['required', 'string', 'max:500', 'regex:/^FR76[0-9]{24}$/'],
            'nomcompte' => ['required', 'string', 'max:500'],
        ]);

        $userId = auth()->user()->idutilisateur;  // Récupérer l'ID de l'utilisateur connecté

        // Mettre à jour les informations bancaires pour l'utilisateur connecté
        $identiteBancaire = IdentiteBancaire::where('idutilisateur', $userId)->first();

        if ($identiteBancaire) {
            $identiteBancaire->update([
                'numerocompte' => Crypt::encrypt( $request ->numerocompte),
                'nomcompte' => Crypt::encrypt( $request ->nomcompte),
            ]);


        }

        return redirect()->route('profile.mesinfosbancaire');
    }

    public function suppinfosbancaire(Request $request)
    {

        $userId = auth()->user()->idutilisateur;  // Récupérer l'ID de l'utilisateur connecté

        // Mettre à jour les informations bancaires pour l'utilisateur connecté
        $identiteBancaire = IdentiteBancaire::where('idutilisateur', $userId)->first();

        if ($identiteBancaire) {
            $identiteBancaire->delete();

            return redirect()->back();

        }

        return redirect()->back()->with('message', 'Erreur dans la suppression de vos informations.');

    }

    public function addinfosbancaire(Request $request) : RedirectResponse
    {
        $request->validate([
            'numerocompte' => ['required', 'string', 'max:500', 'regex:/^FR76[0-9]{24}$/'],
            'nomcompte' => ['required', 'string', 'max:500'],
        ]);

        $userId = auth()->user()->idutilisateur;

        $identiteBancaire = IdentiteBancaire::create([
            'idutilisateur' => $userId, 
            'numerocompte' => Crypt::encrypt($request->numerocompte),
            'nomcompte' => Crypt::encrypt($request->nomcompte),
        ]);

        return redirect()->route('profile.mesinfosbancaire');
    }



    

}

