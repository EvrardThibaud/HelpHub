<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentiteBancaire extends Model
{
    use HasFactory;
    protected $table = "identitebancaire";
    protected $primaryKey = "numerocompte";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'numerocompte',
        'idutilisateur',
        'nomcompte',
    ];
}
