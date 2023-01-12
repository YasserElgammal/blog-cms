<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->unique()->word();
        $slug = str($name)->slug();
        return [
            'user_id' => rand(1,10),
            'name' => $name,
            'content' => fake()->paragraph(6),
            'navbar' => fake()->boolean(),
            'footer' => fake()->boolean(),
            'slug' => $slug,
        ];
    }
}
