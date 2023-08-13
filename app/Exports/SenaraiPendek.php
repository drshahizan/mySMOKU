<?php

namespace App\Exports;

use App\Models\Permohonan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class SenaraiPendek implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permohonan::all();
    }
}
