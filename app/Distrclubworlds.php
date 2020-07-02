<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrclubworlds extends Model
{
    protected $fillable = [
        'id_distrito', 'id_clube', 'dsc_clube',
    ];
}
