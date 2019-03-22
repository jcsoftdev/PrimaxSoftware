<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre','apellidos','dni','email','telefono'];
    public function venta()
    {
        return $this->hasMany('App\Models\Venta');
    }
}
