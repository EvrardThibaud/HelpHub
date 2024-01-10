<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAction extends Model
{
    use HasFactory;
    protected $table = "typeaction";
    protected $primaryKey = "idtypeaction";
    public $timestamps = false;
    public $incrementing = true;
    // public $incrementing = false;

    protected $fillable = [
        'libelletype',
        // Autres attributs...
    ];

}
