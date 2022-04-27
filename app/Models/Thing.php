<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Type;
use App\Models\State;
use App\Models\Order;
use App\Models\History;

class Thing extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'state',
        'order_id',
        'name',
        'identifier',
        'description',
        'visibility',
        'place'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function histories()
    {
        return $this->belongsToMany(History::class);
    }
}
