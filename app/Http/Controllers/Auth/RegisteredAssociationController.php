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
use App\Models\Association;

class RegisteredAssociationController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register_association');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nomassociation' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Association::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'numtelassociation' => ['required', 'numeric','digits:10'],
            'sitewebassociation' => ['required', 'string'],
            'descriptionassociation' => ['required', 'string'],
        ]);

        // Vérifier si l'association existe pour l'id donnée'
        $asso = Association::where('idassociation', $request->idassociation)->first();

        if (!$asso) {
            // Si l'asso n'existe pas, créez-la
            $asso = Association::create([
                'email' => $request->email,
                'nomassociation' => $request->nomassociation,
                'numtelassociation' => $request->numtelassociation,
                'descriptionassociation' => $request->descriptionassociation,
                'sitewebassociation' => $request->sitewebassociation,
                'password' => Hash::make($request->password),
            ]);
        }

        $user = User::create([
            'prenomutilisateur' => $request->nomassociation,
            'nomutilisateur' => $request->nomassociation,
            'numtelephone' => $request->numtelassociation,
            'email' => $request->email,
            'codepostaladresse' => $request->codepostaladresse,
            'rue' => $request->rue,
            'password' => Hash::make($request->password),
            'idassociation' => $asso->idassociation,
        ]);

        $user->association()->associate($asso);
        $user->save();
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
