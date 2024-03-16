<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{

    protected $model;

    public function __construct()
    {
        $this->model = new Tag();
    }

    public function run(): void
    {
        $this->model->factory()->count(53)->create();
    }
}
