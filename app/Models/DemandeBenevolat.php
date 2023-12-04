<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeBenevolat extends Model
{
    use HasFactory;
    protected $table = "demandebenevolat";
    protected $primaryKey = "idaction";
    public $timestamps = false;
    // public $incrementing = false;
}
