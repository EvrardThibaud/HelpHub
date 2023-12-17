<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLike extends Model
{
    use HasFactory;

    protected $table = "action_like";
    protected $primaryKey = ['idaction', 'idutilisateur'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['idaction', 'idutilisateur'];

    public function association()
    {
        return $this->belongsTo(Association::class, 'idassociation');
    }
   

    
}
