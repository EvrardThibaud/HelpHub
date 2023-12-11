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

    protected $fillable = [
        'titreaction',
        'idassociation',
        'descriptionaction',
        'idmedia',
    ];

    public function media() {
        return $this->belongsTo(Media::class, 'idmedia', 'idmedia');
    }
    public function association() {
        return $this->belongsTo(Association::class, 'idassociation', 'idassociation');
    }

    public function demandebenevolat() {
        return $this->belongsTo(DemandeBenevolat::class, 'idaction', 'idaction');
    }
    public function demandedon() {
        return $this->belongsTo(DemandeDon::class, 'idaction', 'idaction');
    }
    public function information() {
        return $this->belongsTo(Information::class, 'idaction', 'idaction');
    }
    
    public function likes(){
        return $this->hasMany(ActionLike::class, 'idaction', 'idaction');
    }
    public function participationbenevolat() {
        return $this->hasMany(ParticipationBenevolat::class, 'idaction', 'idaction');
    }

    public function participationdon() {
        return $this->hasMany(ParticipationDon::class, 'idaction', 'idaction');
    }

    public function thematiques() {
        return $this->hasMany(ThematiqueAction::class, 'idaction', 'idaction');
    }


}
