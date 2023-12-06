<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getAddressSuggestions(Request $request)
    {
        $input = $request->input('input'); // Récupérer la valeur de l'input
        $url = 'https://api-adresse.data.gouv.fr/search/?q=' . urlencode($input) . '&type=street&autocomplete=1&limit=5';

        // Faire la requête à l'API
        $response = Http::get($url);

        // Renvoyer le JSON récupéré en réponse
        return $response->json();
    }
}
