<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guest()
    {
        $this->get('people')->assertRedirect('login');
        $this->get('people/create')->assertRedirect('login');
        $this->get('people/1/edit')->assertRedirect('login');
        $this->get('people/1')->assertRedirect('login');
        $this->post('people', [])->assertRedirect('login');
        $this->delete('people/1')->assertRedirect('login');
        $this->put('people/1')->assertRedirect('login');
    }

    public function test_index_with_data()
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get('people')
            ->assertStatus(200)
            ->assertSee($person->name)
            ->assertSee($person->place);
    }

    public function test_store()
    {
        $user = User::factory()->create();

        $data = [
            'name'  => $this->faker->name,
            'place' => $this->faker->sentence,
        ];

        $this
            ->actingAs($user)
            ->post('people', $data);

        $this->assertDatabaseHas('people', $data);
    }

    public function test_validation_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('people', [])
            ->assertStatus(302);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $this
            ->actingAs($user)
            ->delete("people/$person->id");

        $this->assertDatabaseMissing('people', ['id' => $person->id]);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $this
            ->actingAs($user)
            ->get("people/$person->id")
            ->assertStatus(200);
    }


}
