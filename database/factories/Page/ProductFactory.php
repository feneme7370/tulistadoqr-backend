<?php

namespace Database\Factories\Page;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->name(),
            'price_original' => $this->faker->numberBetween(1000,3000),
            'price_seller' => $this->faker->numberBetween(1000,3000),
            'quantity' => $this->faker->numberBetween(1,30),
            'image_hero' => '',
            'image_logo' => '',
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->numberBetween(0,1),
            'category_id' => $this->faker->numberBetween(1,3),
            'level_id' => $this->faker->numberBetween(1,3),
            'user_id' => $this->faker->numberBetween(2,4),
            'company_id' => $this->faker->numberBetween(2,4),
        ];
    }
}
