<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Thing;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function things()
    {
        return $this->hasMany(Thing::class);
    }
}
