<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->randomElement(['Ronaldo To Alnaseer','Messi Inter','Ronaldo','Nemar','Mohammed Salah','US']),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

            'user_id' => User::factory()->hasAttached([Role::whereName('Author')->where('guard_name', 'web')->first(),Role::where('name','Author')->where('guard_name', 'api')->first()]),
        ];
    }
}
