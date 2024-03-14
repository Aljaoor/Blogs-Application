<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->text($this->faker->numberBetween(5, 250)),
            'image' => $this->faker->imageUrl(640,480,'sport'),
            'description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'published_at' => $this->faker->date('Y-m-d H:i:s'),
            'active' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

            'author_id' => User::factory(),
        ];
    }


    public function withTags(array $tagIds = []): Factory
    {
        return $this->afterCreating(function (Post $post) use ($tagIds) {
            $post->tags()->attach($tagIds);
        });
    }
}
