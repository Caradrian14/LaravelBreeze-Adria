<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ganga>
 */
class GangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => $this->faker->sentence(4),
            'url' =>$this->faker->word(),
            'likes' => $this->faker->randomDigit(),
            'unlikes' => $this->faker->randomDigit(),
            'price' => $this->faker->randomDigit(),
            'price_sale' => $this->faker->randomDigit(),
            'user_id'=>User::inRandomOrder()->first()->id,
            'category'=>Category::inRandomOrder()->first()->id,
        ];
    }
}
