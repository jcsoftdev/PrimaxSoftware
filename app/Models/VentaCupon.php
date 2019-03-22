<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaCupon extends Model
{
    protected $table = 'venta_cupons';
    protected $fillable = ['idcupon','idventa'];
    // public $timestamps = false;
    public function venta()
    {
        return $this->hasMany('App\Models\VentaCupon');
    }
}
