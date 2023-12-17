<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueVisu extends Model
{
    use HasFactory;
    protected $table = "historique_visu";
    protected $primaryKey = ["idaction","idutilisateur"];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'idaction',
        'idutilisateur',
        'numerovisu',
    ];

    public function actions()
    {
        return $this->hasOne(Action::class, 'idaction', 'idaction');
    }

}
