<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user'             => 'Jose',
            'person_name'      => 'Raul',
            'person_last_name' => 'Gomez',
            'identifier'       => 'Evento',
        ];
    }
}
