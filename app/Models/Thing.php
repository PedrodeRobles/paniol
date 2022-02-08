<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Type;
use App\Models\State;

class Thing extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'state_id',
        'name',
        'description',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    //Query Scopes
    // public function scopeName($query, $name)
    // {
    //     if($name)
    //         return $query->where('name', 'LIKE', "%$name%");
    // }

    // public function scopeType($query, $type_id)
    // {
    //     if($type_id)
    //         return $query->where('type_id', 'LIKE', "%$type_id%");
    // }

    // public function scopeState($query, $state)
    // {
    //     if($state)
    //         return $query->where('state', 'LIKE', "%$state%");
    // }
}
