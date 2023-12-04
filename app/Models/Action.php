<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = "action";
    protected $primaryKey = "idaction";
    public $timestamps = false;


    public function media() {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }
}
