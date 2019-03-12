<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    public $timestamps = false;
    protected $filleable = ['serial','condicion','actualizaciones','expiracion'];
}
