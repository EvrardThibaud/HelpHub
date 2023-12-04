<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThematiqueAction extends Model
{
    use HasFactory;
    protected $table = "thematique_action";
    protected $primaryKey = ['idthematique', 'idaction'];
    public $incrementing = false;
    public $timestamps = false;
}
