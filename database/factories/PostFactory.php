<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     
    public function definition()
    {
        $title = fake()->unique()->sentence(mt_rand(2,8));
        $slug = Str::slug($title, '-');

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraph(mt_rand(10,25)),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
