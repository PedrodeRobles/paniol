<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_index_with_data()
    {
        // $user = User::factory()->create();
        // $person = Person::factory()->create();
        $order = Order::factory()->create();

        $this
            ->get('order')
            ->assertStatus(200)
            ->assertSee($order->id)
            ->assertSee($order->person->name)
            ->assertSee($order->user_id)
            ->assertSee($order->return );
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $data = [
            'user_id' => $user->id,
            'person_id' => $person->id,
            'identifier' => 'Evento',
            'return' => 1
        ];

        $this  
            ->actingAs($user)
            ->post('order', $data);

        $this->assertDatabaseHas('orders', $data);
    }

    public function test_validation_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('order', [])
            ->assertStatus(302);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        $this
            ->actingAs($user)
            ->delete("order/$order->id");

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
