<?php

namespace Tests\Unit\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_many_things()
    {
        $type = Type::factory()->create();

        $this->assertInstanceOf(Collection::class, $type->things);
    }
}
