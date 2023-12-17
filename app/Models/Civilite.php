<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civilite extends Model
{
    use HasFactory;
    protected $table = "civilite";
    protected $primaryKey = "idcivilite";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'libellecivilite',
    ];

    
}
