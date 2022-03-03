<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Person([
            'id'         => $row[0],
            'name'       => $row[1],
            'place'      => $row[2],
            'created_at' => $row[3],
            'updated_at' => $row[4],
        ]);
    }
}
