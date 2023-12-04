<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Password::defaults(function () {
        //     return [
        //         'length' => 12, // Nouvelle longueur minimale du mot de passe
        //         'use_numbers' => true, // Désactiver l'utilisation des chiffres
        //         'use_special_characters' => true,
        //         'use_uppercase' => true,
        //     ];
        // });
    }
}
