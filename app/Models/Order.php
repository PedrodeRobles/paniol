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
        'thing_id'
    ];

    public function thing()
    {
        return $this->belongsTo(Thing::class);
    }
}
