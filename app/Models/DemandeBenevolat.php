<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeBenevolat extends Model
{
    use HasFactory;
    protected $table = "demandebenevolat";
    protected $primaryKey = "idaction";
    public $timestamps = false;
    // public $incrementing = false;

    protected $fillable = [
        'idaction',
        'codepostaladresse',
        'competencesrequisesdb',
        'nombreparticipantdb',
        'estpresentieldb',
    ];

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'codepostaladresse', 'codepostaladresse');
    }
}
