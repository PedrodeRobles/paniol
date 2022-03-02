<?php

namespace App\Exports;

use App\Models\Thing;
use Maatwebsite\Excel\Concerns\FromCollection;

class ThingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Thing::all();
    }
}
