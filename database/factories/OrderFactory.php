<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'person_id' => Person::factory()->create(),
            'identifier' => $this->faker->word(),
            'return' => 1,
        ];
    }
}
