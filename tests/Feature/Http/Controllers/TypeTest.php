<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Type;
use App\Models\User;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guest()
    {
        $this->get('type')->assertRedirect('login');
        $this->get('type/1')->assertRedirect('login');
        $this->get('type/1/edit')->assertRedirect('login');
        $this->get('type/create')->assertRedirect('login');
        $this->post('type', [])->assertRedirect('login');
        $this->delete('type/1')->assertRedirect('login');
        $this->put('type/1')->assertRedirect('login');
    }

    public function test_index_with_data()
    {
        $user = User::factory()->create();
        $type = Type::factory()->create();

        $this
            ->actingAs($user)
            ->get('type')
            ->assertStatus(200)
            ->assertSee($type->type);
    }

    public function test_store()
    {
        $user = User::factory()->create();

        $data = ['type' => $this->faker->word];

        $this
            ->actingAs($user)
            ->post('type', $data);

        $this->assertDatabaseHas('types', $data);
    }

    public function test_validation_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('type', [])
            ->assertStatus(302);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $type = Type::factory()->create();

        $this
            ->actingAs($user)
            ->delete("type/$type->id");

        $this->assertDatabaseMissing('types', ['id' => $type->id]);
    }
}
