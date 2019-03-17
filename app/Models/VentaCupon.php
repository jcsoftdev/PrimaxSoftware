<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaCupon extends Model
{
    protected $table = 'venta_cupons';
    protected $fillable = ['idcupon','idventa'];
    // public $timestamps = false;
    public function ventaCupon()
     {
         return $this->belongsTo('App\Models\VentaCupon');
     }
}
