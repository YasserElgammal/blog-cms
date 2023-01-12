<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    // protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        $slug = str($title)->slug();
        return [
            'user_id' => rand(1,10),
            'cat_id' => rand(1,5),
            'title' => $title,
            'content' => fake()->paragraph(6),
            'status' => fake()->boolean(),
            'slug' => $slug,
            'image' => 'dummy.jpg',
            'content' => fake()->paragraph(),
        ];
    }
}
