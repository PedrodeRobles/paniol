<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrdersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'id'         => $row[0],
            'user_id'    => $row[1],
            'person_id'  => $row[2],
            'identifier' => $row[3],
            'return'     => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6],
        ]);
    }
}
