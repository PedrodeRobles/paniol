<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Transaction;

use App\Models\Thing;
use App\Models\User;
use App\Models\Person;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'user_id',
        'person_id',
        'return',
        'other_things',
    ];

    public function things()
    {
        return $this->hasMany(Thing::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
