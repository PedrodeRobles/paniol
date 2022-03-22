<?php

namespace Tests\Unit\Models;

use App\Models\Type;
use Illuminate\Support\Collection;
use Tests\TestCase;

class TypeTest extends TestCase
{
    public function test_has_many_things()
    {
        $type = Type::factory()->create();

        $this->assertInstanceOf(Collection::class, $type->things);
    }
}
