<?php

namespace App\Imports;

use App\Models\Thing;
use Maatwebsite\Excel\Concerns\ToModel;

class ThingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Thing([
            'id'          => $row[0],
            'type_id'     => $row[1],
            'order_id'    => $row[2],
            'name'        => $row[3],
            'state'       => $row[4],
            'identifier'  => $row[5],
            'description' => $row[6],
            'visibility'  => $row[7],
            'created_at'  => $row[8],
            'updated_at'  => $row[9],
        ]);
    }
}
