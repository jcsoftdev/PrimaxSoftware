<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['idpersona','idmarca','fecha','localizacion','cantidad','total'];
    // public $timestamps = false;
    public function ventaCupon()
    {
        return $this->hasMany('App\Models\VentaCupon');
    }
    public function marca()
    {
        return $this->belongsTo('App\Models\Marca');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }
}
