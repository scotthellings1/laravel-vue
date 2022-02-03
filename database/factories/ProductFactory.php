<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique->product(),
            'description' => $this->faker->sentence(),
            'price' => rand(500, 999) / 10,
        ];
    }
}
