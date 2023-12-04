<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDon extends Model
{
    use HasFactory;
    protected $table = "demande_don";
    protected $primaryKey = "idaction";
    public $timestamps = false;
    // public $incrementing = false;
}
