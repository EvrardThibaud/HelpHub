<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateur';
    protected $primaryKey = 'idutilisateur';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenomutilisateur',
        'nomutilisateur',
        'rue',
        'codepostaladresse',
        'numtelephone',
        'email',
        'password',
        'newsletter',
        'notification',
        'idcivilite',
        'datenaissance',
        'last_connection',
        'dpo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'codepostaladresse', 'codepostaladresse');
    }


    public function media()
    {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }

    public function association()
    {
        return $this->belongsTo(
            Association::class, 'idassociation', 'idassociation'
        );
    }

    public function servicediffusion()
    {
        return $this->belongsTo(ServiceDiffusion::class, 'idservicediffusion', 'idservicediffusion');
    }

    public function historiquevisu()
    {
        return $this->hasMany(HistoriqueVisu::class, 'idutilisateur', 'idutilisateur')->orderBy('numerovisu', 'asc');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'idutilisateur', 'idutilisateur')->orderBy('datenotification', 'asc');
    }

    public function actionLike()
    {
        return $this->hasOne(ActionLike::class, 'idutlisateur', 'idutlisateur');
    }

    public function civilite()
    {
        return $this->hasOne(Civilite::class, 'idcivilite', 'idcivilite');
    }

    public function participationdon()
    {
        return $this->hasMany(ParticipationDon::class, 'idutilisateur', 'idutilisateur');
    }
    public function participationbenevole()
    {
        return $this->hasMany(ParticipationBenevolat::class, 'idutilisateur', 'idutilisateur');
    }

    public function isAdmin()
    {
        // Vérifiez si la colonne 'admin' est définie à true (ou 1, selon la configuration)
        return $this->admin === true; // Assurez-vous que 'admin' correspond à votre colonne booléenne
    }
    
}
