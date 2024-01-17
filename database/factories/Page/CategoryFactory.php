<?php

namespace Database\Factories\Page;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(1),
            'slug' => Str::slug($this->faker->sentence(1)),
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->numberBetween(0,1),
            'user_id' => $this->faker->numberBetween(2,4),
            'company_id' => $this->faker->numberBetween(2,4),
        ];
    }
}
