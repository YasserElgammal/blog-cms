<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => fake()->word(),
            'contact_email' => fake()->email(),
            'description' => fake()->sentence(),
            'about' => fake()->paragraph(1),
            'copy_rights' => fake()->sentence(),
            'url_fb' => fake()->url(),
            'url_twitter' => fake()->url(),
            'url_insta' => fake()->url(),
            'url_linkedin' => fake()->url(),
        ];
    }
}
