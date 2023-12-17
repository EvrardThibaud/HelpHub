<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    use HasFactory;
    protected $table = "thematique";
    protected $primaryKey = "idthematique";
    public $timestamps = false;

    protected $fillable = [
        'libellethematique'
    ];
}
