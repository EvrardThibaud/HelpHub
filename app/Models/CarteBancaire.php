<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteBancaire extends Model
{
    use HasFactory;
    protected $table = "cartebancaire";
    protected $primaryKey = "numerocarte";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'numerocarte',
        'idutilisateur',
        'dateexpiration',
        'cryptogramme',
        'nomcarte',
    ];
}
