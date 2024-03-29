<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $body = $this->faker->paragraph(15);
        return [
            'title' => $title,
            'body' => Str::words($body, 15 ),
            'slug' => Str::slug($title),
            'user_id' => User::factory(),
            'lang' => 'en',
            'summary' => $this->faker->sentence(12),
            'is_featured' => (bool)random_int(0, 1),
            'status' => 'PUBLISHED',


        ];
    }
}
