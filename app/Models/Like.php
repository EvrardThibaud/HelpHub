<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Like extends Model
    {
        use HasFactory;

        protected $table = "likes";
        protected $primaryKey = "idlike";
        public $timestamps = false;

        protected $fillable = [
            'idutilisateur',
            // Autres attributs...
        ];
    }

