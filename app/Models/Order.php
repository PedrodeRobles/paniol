<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Transaction;

use App\Models\Thing;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
    ];

    public function things()
    {
        return $this->hasMany(Thing::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
