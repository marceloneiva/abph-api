<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campanhas extends Model
{
    //
    protected $fillable = [
        'dsc_campanha', 'ini_campanha', 'fim_campanha','ativo', 'encerrada',
    ];
}
