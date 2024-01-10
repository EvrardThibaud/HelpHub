<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function createAsso(): View
    {
        return view('auth.login_asso');
    }


    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        // Authentification utilisateur
        if (Auth::guard('web')->attempt($credentials)) {
            // Authentification réussie pour les utilisateurs
            $request->session()->regenerate();

            User::where('idutilisateur', auth()->user()->idutilisateur)->update(['last_connection' => now()]);
            
            return redirect()->intended(RouteServiceProvider::HOME);
        }


        // Redirection en cas d'échec de l'authentification
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    
    public function storeAsso(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        // Authentification utilisateur
        if (Auth::guard('association')->attempt($credentials)) {
            // Authentification réussie pour les utilisateurs
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // Redirection en cas d'échec de l'authentification
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    
    

    

    /**
     * Destroy an authenticated session.
     */

    
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('association')->check()) {
            Auth::guard('association')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

 
    
}
