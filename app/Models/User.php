<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['idpersona','idrol','username','password','condition'];
    // public $timestamps = false;
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol');
    }
    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }
}
