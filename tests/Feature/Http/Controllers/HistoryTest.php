<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\History;
use App\Models\Thing;
use App\Models\User;

class HistoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_with_data()
    {
        $history = History::factory()->create();

        $this
            ->get('history')
            ->assertStatus(200)
            ->assertSee($history->id)
            ->assertSee($history->person)
            ->assertSee($history->identifier)
            ->assertSee($history->user)
            ->assertSee($history->created_at->format('d M Y'))
            ->assertSee($history->updated_at->format('d M Y'));
    }

    public function test_show()
    {
        $history = History::factory()->create();

        $this
            ->get("history/$history->id")
            ->assertStatus(200)
            ->assertSee($history->id)
            ->assertSee($history->person)
            ->assertSee($history->identifier)
            ->assertSee($history->user)
            ->assertSee($history->created_at->format('d M Y'))
            ->assertSee($history->updated_at->format('d M Y'));
    }
}
