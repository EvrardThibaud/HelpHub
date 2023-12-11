<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{

    use HasFactory;
    protected $table = "association";
    protected $primaryKey = "idassociation";
    public $timestamps = false;


    protected $fillable = [
        'nomassociation',
        'numtelassociation',
        'email',
        'sitewebassociation',
        'descriptionassociation',
        'password',
    ];



    public function media() {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }


    public function actions()
    {
        return $this->hasMany(
            Action::class, 'idassociation', 'idassociation'
        );
    }

}
