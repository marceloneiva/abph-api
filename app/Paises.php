<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $fillable = [
        'id', 'cod_cont ','local_name',
    ];
}
