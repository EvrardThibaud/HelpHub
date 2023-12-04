<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $table = "adresse";
    protected $primaryKey = "codepostaladresse";
    public $timestamps = false;

    protected $fillable = ['codepostaladresse', 'villeadresse', 'numdepartement']; // Ajout de 'codepostaladresse'


}
