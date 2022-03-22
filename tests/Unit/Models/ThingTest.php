<?php

namespace Tests\Unit\Models;

use App\Models\Thing;
use App\Models\Order;
use App\Models\Type;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThingTest extends TestCase
{  
    use RefreshDatabase;

    public function test_belongs_to_order()
    {
        $thing = Thing::factory()->create();

        $this->assertInstanceOf(Order::class, $thing->order);
    }

    public function test_belongs_to_type()
    {
        $thing = Thing::factory()->create();

        $this->assertInstanceOf(Type::class, $thing->type);
    }

    public function test_has_many_histories()
    {
        $thing = Thing::factory()->create();

        $this->assertInstanceOf(collection::class, $thing->histories);
    }
}
