<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $table = 'candidature';
    protected $primaryKey = 'idcandidature';

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
        'datenaissance',
        'civilite'
    ];
}
