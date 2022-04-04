<?php

namespace Tests\Unit\Models;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_many_things()
    {
        $history = History::factory()->create();

        $this->assertInstanceOf(Collection::class, $history->things);
    }
}
