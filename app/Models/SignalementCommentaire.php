<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalementCommentaire extends Model
{
    use HasFactory;
    protected $table = "signalement_commentaire";
    protected $primaryKey = "idsignalement";
    public $timestamps = false;

    protected $fillable = [
        'idcommentaire',
        'idutilisateur',
        'datesignalement',
        'contenusignalement'
    ];

    // public function media() {
    //     return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    // }
}
