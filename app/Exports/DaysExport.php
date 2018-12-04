<?php

namespace App\Exports;

use App\Day;
use Maatwebsite\Excel\Concerns\FromCollection;

class DaysExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Day::all();
    }
}
