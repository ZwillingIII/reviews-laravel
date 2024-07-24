<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $faker = Faker::create('ru_RU');
//        $randomSentence = $faker->realText();

        return [
            'title' => fake('ru_RU')->word(),
            'description' => fake('ru_RU')->realText(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
