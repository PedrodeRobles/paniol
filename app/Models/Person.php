<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Transaction;
use App\Models\Order;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'place',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
