<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_id'     => Type::factory()->create(),
            'order_id'    => Order::factory()->create(),
            'name'        => 'Destornillador',
            'state'       => 1,
            'identifier'  => 'HER-DES-1',
            'description' => 'descripción...',
            'visibility'  => 1,
        ];
    }
}
