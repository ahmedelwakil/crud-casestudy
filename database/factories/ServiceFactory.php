<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->colorName(),
            'description' => fake()->sentences(5, true),
            'price' => fake()->randomFloat(2, 100, 1000),
            'duration' => fake()->randomNumber(3),
        ];
    }
}
