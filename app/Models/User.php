<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     protected $fillable = [
        'id', 'usuario', 'password','condicion','idrol', 'remember_token'
    ];
    
    // public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){
        return $this->belongsTo('App\Models\Rol');
    }

    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
}
