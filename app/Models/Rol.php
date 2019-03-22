<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    protected $fillable = ['nombre','descripcion','condicion'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
