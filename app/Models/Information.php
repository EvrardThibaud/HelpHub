<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = "information";
    protected $primaryKey = "idaction";
    public $timestamps = false;
    // public $incrementing = false;

    protected $fillable = [
        'idaction',
    ];
}
