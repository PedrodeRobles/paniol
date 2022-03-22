<?php

namespace Tests\Unit\Models;

use App\Models\Person;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class PersonTest extends TestCase
{
    public function test_has_many_orders()
    {
        $person = new Person;
        $this->assertInstanceOf(Collection::class, $person->orders);
    }
}
