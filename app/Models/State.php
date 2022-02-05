<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Thing;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
    ];

    public function things()
    {
        return $this->hasMany(Thing::class);
    }
}
