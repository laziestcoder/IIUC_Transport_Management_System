<?php

namespace App\Imports;

use App\Day;
use Maatwebsite\Excel\Concerns\ToModel;

class DaysImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Day([
            //
        ]);
    }
}
