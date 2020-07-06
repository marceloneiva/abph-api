<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendas extends Model
{
    protected $fillable = [
        'id_agente', 'telefone', 'email','nome', 'data_agendada','retornado',
        'id_cont',
        'id_pais',
        'id_distclub',
        'id_distrito',
        'id_campanha',
    ];
}



    