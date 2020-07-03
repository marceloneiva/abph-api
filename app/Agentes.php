<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agentes extends Model
{
    protected $fillable = [
        'id_user', 'cod_sip', 'dsc_agent','ativo', 'id_tipoagent',
    ];
    
    
}
