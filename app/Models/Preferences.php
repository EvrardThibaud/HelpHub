<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    use HasFactory;
    protected $table = "preferences";
    protected $primaryKey = "idpreferences";
    public $timestamps = false;
    public $incrementing = true;
    // public $incrementing = false;

    protected $fillable = [
        'idutilisateur',
        'idassociation',
        'idthematique',
        'idtypeaction',
    ];

}