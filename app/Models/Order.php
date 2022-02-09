<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Thing;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'name_of_thing'
    ];

    public function things()
    {
        return $this->hasMany(Thing::class);
    }
}
