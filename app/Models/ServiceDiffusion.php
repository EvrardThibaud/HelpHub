<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDiffusion extends Model
{
    use HasFactory;
    protected $table = "service_diffusion";
    protected $primaryKey = "idservicediffusion";
    public $timestamps = false;

}
