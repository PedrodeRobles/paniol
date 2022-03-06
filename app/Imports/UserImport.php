<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id'                 => $row[0],
            'name'               => $row[1],
            'email'              => $row[2],
            'email_verified_at'  => $row[3],
            'password'           => bcrypt('12345678'),
            'current_team_id'    => $row[5],
            'profile_photo_path' => $row[6],
            'created_at'         => $row[7],
            'updated_at'         => $row[8],
        ]);
    }
}
