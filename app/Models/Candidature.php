<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $table = 'candidature';
    protected $primaryKey = 'idcandidature';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idetatcandidature',
        'idaction',
        'idutilisateur',
        'informationscandidature',
        'civilite'
    ];

    public function etatCandidature()
    {
        return $this->hasOne(EtatCandidature::class, 'idetatcandidature', 'idetatcandidature');
    }

    public function action()
    {
        return $this->hasOne(Action::class, 'idaction', 'idaction');
    }
}
