<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\CarteBancaire;
use Illuminate\Http\RedirectResponse;

class CarteBancaireController extends Controller
{
    public function updatecartebancaire(Request $request) : RedirectResponse
    {

        $request->validate([
            'numerocarte' => ['required', 'string', 'max:16', 'min:16', 'regex:/^[0-9]{16}$/'],
            'dateexpiration' => ['required', 'string', 'max:5', 'min:5', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'cryptogramme' => ['required', 'string', 'max:3', 'min:3', 'regex:/^[0-9]{3}$/'],
            'nomcarte' => ['required', 'string', 'max:500'],
        ]);

        // Récupère l'ID de l'utilisateur actuellement authentifié
        $userId = auth()->user()->idutilisateur;            
        // Recherche une carte bancaire associée à cet utilisateur
        $carteBancaire = CarteBancaire::where('idutilisateur', $userId)->first();
        // Vérifie si une carte bancaire existe
        if ($carteBancaire) {
            // Met à jour les informations de la carte bancaire dans la base de données
            $carteBancaire->update([
                // Crypte le numéro de carte avant de le stocker
                'numerocarte' =>  Crypt::encrypt($request->numerocarte),
                // Crypte la date d'expiration avant de la stocker
                'dateexpiration' =>  Crypt::encrypt($request->dateexpiration),
                // Crypte    le cryptogramme avant de le stocker
                'cryptogramme' =>  Crypt::encrypt($request->cryptogramme),
                // Crypte le nom de la carte avant de le stocker
                'nomcarte' => Crypt::encrypt($request->nomcarte),
            ]);
        }

        return redirect()->route('profile.mesinfosbancaire');
    }

    public function suppcartebancaire(Request $request)
    {

        $userId = auth()->user()->idutilisateur;  

        $carteBancaire = CarteBancaire::where('idutilisateur', $userId)->first();

        if ($carteBancaire) {
            $carteBancaire->delete();

            return redirect()->back();

        }

        return redirect()->back()->with('message', 'Erreur dans la suppression de votre carte.');

    }

    public function addcartebancaire(Request $request) : RedirectResponse
    {

        $request->validate([
            'numerocarte' => ['required', 'string', 'max:16', 'min:16', 'regex:/^[0-9]{16}$/'],
            'dateexpiration' => ['required', 'string', 'max:5', 'min:5', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'cryptogramme' => ['required', 'string', 'max:3', 'min:3', 'regex:/^[0-9]{3}$/'],
            'nomcarte' => ['required', 'string', 'max:500'],
        ]);

        $userId = auth()->user()->idutilisateur;  // Récupérer l'ID de l'utilisateur connecté

        $carteBancaire = CarteBancaire::create([
            'idutilisateur' => $userId, 
            'numerocarte' =>  Crypt::encrypt($request ->numerocarte),
            'dateexpiration' =>  Crypt::encrypt($request ->dateexpiration),
            'cryptogramme' =>  Crypt::encrypt($request ->cryptogramme),
            'nomcarte' =>  Crypt::encrypt($request ->nomcarte),
        ]);


        return redirect()->route('profile.mesinfosbancaire');
    }


    

}

