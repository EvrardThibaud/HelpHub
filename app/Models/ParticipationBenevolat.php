<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipationBenevolat extends Model
{
    use HasFactory;
    protected $table = "participationbenevolat";
    protected $primaryKey = "idparticipationbenevolat";
    public $timestamps = false;
    // public $incrementing = false;

    public function action()
    {
        return $this->belongsTo(Action::class, 'idaction', 'idaction');
    }
}
