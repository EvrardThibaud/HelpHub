<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LesAssociation extends Model
{
    use HasFactory;
    protected $table = "association";
    protected $primaryKey = "idassociation";
    public $timestamps = false;

    public function media() {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }



}
