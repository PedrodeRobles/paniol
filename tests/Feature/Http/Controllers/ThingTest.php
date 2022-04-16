<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Thing;
use App\Models\Order;
use App\Models\Type;
use App\Models\Person;


class ThingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_with_data()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $order = Order::factory()->create([
            'person_id' => $person->id,
            'user_id'   => $user->id
            ]);
        $type = Type::factory()->create();
        $thing = Thing::factory()->create([
            'order_id' => $order->id,
            'type_id'  => $type->id
            ]);
        
        $this
            ->get('thing')
            ->assertStatus(200)
            ->assertSee($thing->identifier)
            ->assertSee($thing->name)
            ->assertSee($thing->type->type)
            ->assertSee($thing->order->person_id)
            ->assertSee($thing->order->id);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $order = Order::factory()->create([
            'person_id' => $person->id,
            'user_id'   => $user->id
            ]);
        $type = Type::factory()->create(['type' => 'Audio']);

        $data = [
            'type_id'    => $type->id,
            'order_id'   => $order->id,
            'name'       => 'Microfono',
            'state'       => 1,
            // 'identifier' => 'AUD-MIC-2',
            'visibility' => 1,
            'description' => $this->faker->sentence(),
        ];

        $this
            ->actingAs($user)
            ->post('thing', $data);

            $this->assertDatabaseHas('things', $data);
    }

    public function test_validation_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('thing', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['type_id', 'name']);
    }

    public function test_create()
    {
        $user = User::factory()->create();
        $type = Type::factory()->create();

        $this
            ->actingAs($user)
            ->get('thing/create')
            ->assertStatus(200)
            ->assertSee($type->id)
            ->assertSee($type->type);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $type = Type::factory()->create();
        $thing = Thing::factory()->create(['type_id' => $type->id]);

        $this
            ->actingAs($user)
            ->get("thing/$thing->id")
            ->assertStatus(200)
            ->assertSee($thing->name)
            ->assertSee($thing->identifier)
            ->assertSee($thing->type->type)
            ->assertSee($thing->state)
            ->assertSee($thing->description);
    }

    public function test_edit()
    {
        $user = User::factory()->create();
        $type = Type::factory()->create();
        $thing = Thing::factory()->create(['type_id' => $type->id]);

        $this
            ->actingAs($user)
            ->get("thing/$thing->id/edit")
            ->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $thing = Thing::factory()->create();

        $data = [
            'name'        => ucfirst($this->faker->word()),
            // 'description' => $this->faker()->sentence(),
        ];

        $this
            ->actingAs($user)
            ->put("thing/$thing->id", $data)
            ->assertRedirect('thing');

            $this->assertDatabaseHas('things', $data);
    }

    public function test_validation_update()
    {
        $user = User::factory()->create();
        $thing = Thing::factory()->create();

        $this
            ->actingAs($user)
            ->put("thing/$thing->id", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name']);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $thing = Thing::factory()->create();

        $this
            ->actingAs($user)
            ->delete("thing/$thing->id");

        $this->assertDatabaseHas('things', [
            'id'    => $thing->id,
            'name'  => $thing->name,
            'visibility' => 2
        ]);
    }

    public function test_restore_thing_of_paper_bin()
    {
        $user = User::factory()->create();
        $thing = Thing::factory()->create();

        $data = [
            'visibility' => 1
        ];

        $this
            ->actingAs($user)
            ->patch("thing/$thing->id", $data);

        $this->assertDatabaseHas('things', [
            'id'    => $thing->id,
            'name'  => $thing->name,
            'visibility' => 1
        ]);
    }

    public function test_view_paper_bin_of_things()
    {
        $user = User::factory()->create();
        $thing = Thing::factory()->create(['visibility' => 2]);

        $this
            ->actingAs($user)
            ->get("thing/bin")
            ->assertStatus(200)
            ->assertSee($thing->identifier)
            ->assertSee($thing->name)
            ->assertSee($thing->type->type)
            ->assertSee('En Pañol')
            ->assertSee('-');
    }
}
