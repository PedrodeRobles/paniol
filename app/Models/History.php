<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Thing;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'user',
        'person_name',
        'person_last_name',
        'type',
    ];

    public function things()
    {
        return $this->belongsToMany(Thing::class);
    }
}
