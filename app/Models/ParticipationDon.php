<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipationDon extends Model
{
    use HasFactory;
    protected $table = "participationdon";
    protected $primaryKey = "idparticipation";
    public $timestamps = false;
    // public $incrementing = false;
}
