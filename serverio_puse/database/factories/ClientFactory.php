<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $test_data = [
            'Optimized grid-enabled moderator',
            'Centralized eco-centric parallelism',
            'Right-sized fault-tolerant application'
        ];

        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'description' => $this->faker->paragraph(3, true),
            'company_title' => $test_data[rand(0, 2)]
        ];
    }
}
