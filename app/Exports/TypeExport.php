<?php

namespace App\Exports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Type::all();
    }
}
