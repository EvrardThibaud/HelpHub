<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Adresse;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'prenomutilisateur' => ['required', 'string', 'max:255'],
            'nomutilisateur' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:100'],
            'codepostaladresse' => ['required', 'int',"digits:5"],
            'numtelephone' => ['required', 'numeric','digits:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        $user = User::create([
            'prenomutilisateur' => $request->prenomutilisateur,
            'nomutilisateur' => $request->nomutilisateur,
            'codepostaladresse' => $request->codepostaladresse,
            'rue' => $request->rue,
            'numtelephone' => $request->numtelephone,
            'email' => $request->email,
            'newsletter' => $request->newsletter,
            'notification' => $request->notification,
            'password' => Hash::make($request->password),
        ]);

        $user->adresse()->associate($adresse);
        $user->save();
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
