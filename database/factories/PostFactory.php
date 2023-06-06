<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
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
        $images_posts_path = 'storage/app/public/images/posts';

        if (!File::exists($images_posts_path)) {
            File::makeDirectory($images_posts_path);
        }
        
        return [
            'user_id' => rand(1,10),
            'category_id' => rand(1,5),
            'title' => $title,
            'content' => fake()->paragraph(6),
            'status' => fake()->boolean(),
            'slug' => $slug,
            'image' => 'images/posts/' . fake()->image($images_posts_path,1000,500, null, false),
            'content' => fake()->paragraph(),
        ];
    }
}
