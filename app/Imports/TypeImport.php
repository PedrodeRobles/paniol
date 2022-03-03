<?php

namespace App\Imports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\ToModel;

class TypeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Type([
            'id'         => $row[0],
            'type'       => $row[1],
            'created_at' => $row[2],
            'updated_at' => $row[3],
        ]);
    }
}
