<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\User;
use App\Models\Person;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(User::class, $order->user);
    }

    public function test_belongs_to_person()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(Person::class, $order->person);
    }

    public function test_has_many_things()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(Collection::class, $order->things);
    }
}
