<?php

namespace App\Exports;

use App\Agendas;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgendasExportw implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agendas::all();
        
    }
}
