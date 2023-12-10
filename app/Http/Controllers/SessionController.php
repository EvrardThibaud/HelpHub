<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function checkSession(Request $request)
    {
        // Récupération de toutes les données de la session
        $sessionData = $request->session()->all();

        // Affichage des données de la session
        dd($sessionData);
    }
}
