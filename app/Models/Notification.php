<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Notification extends Model
    {
        use HasFactory;

        protected $table = "notification";
        protected $primaryKey = "idnotification";
        public $timestamps = false;
        public $incrementing = true;

        protected $fillable = [
            'idutilisateur',
            'idaction',
            'texte',
        ];

        public function action()
        {
            return $this->belongsTo(Action::class, 'idaction');
        }
    }

