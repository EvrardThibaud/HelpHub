<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionMedia extends Model 
{
    use HasFactory;
    protected $table = "action_media";
    protected $primaryKey = ["idmedia", "idaction"];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'idmedia',
        'idaction',
    ];

    public function media() {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }
}
