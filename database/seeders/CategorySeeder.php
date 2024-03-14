<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    protected $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function run(): void
    {
        $this->model->factory()->count(10)->create();
    }
}
