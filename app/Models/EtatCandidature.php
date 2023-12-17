<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatCandidature extends Model
{
    use HasFactory;
    protected $table = "etatcandidature";
    protected $primaryKey = "etatcandidature";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'libelleetatcandidature',
    ];

    
}
