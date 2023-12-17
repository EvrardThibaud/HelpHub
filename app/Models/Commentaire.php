<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    
    protected $table = "commentaire";
    protected $primaryKey = "idcommentaire";
    public $timestamps = false;

    protected $fillable = [
        'idutilisateur',
        'idaction',
        'textecommentaire',
        'nblikecommentaire',
        'datecommentaire'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'idutilisateur', 'idutilisateur');
    }
    public function action()
    {
        return $this->belongsTo(Action::class, 'idaction', 'idaction');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'idcommentaire', 'idcommentaire');
    }
}
