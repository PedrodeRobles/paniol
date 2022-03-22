<?php

namespace Tests\Unit\Models;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    public function test_has_many_things()
    {
        $history = History::factory()->create();

        $this->assertInstanceOf(Collection::class, $history->things);
    }
}
