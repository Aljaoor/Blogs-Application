<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    protected $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function run(): void
    {

        $tags = Tag::get()->pluck('id');
        Post::factory()->count(5)->hasAttached(Category::all()->random(2))->withTags($tags->random(2)->toArray())->create();
        Post::factory()->count(5)->hasAttached(Category::all()->random(2))->withTags($tags->random(2)->toArray())->create();
        Post::factory()->count(5)->hasAttached(Category::all()->random(2))->withTags($tags->random(2)->toArray())->create();
        Post::factory()->count(5)->hasAttached(Category::all()->random(2))->withTags($tags->random(2)->toArray())->create();
        Post::factory()->count(5)->hasAttached(Category::all()->random(2))->withTags($tags->random(2)->toArray())->create();

    }
}
