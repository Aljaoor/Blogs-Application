<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique(false)->randomElement(['Sport', 'Movie', 'Art', 'Word Cup', 'Football', 'Basketball', 'Study', 'Laravel', 'Filament', 'Php', 'CSS']),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
