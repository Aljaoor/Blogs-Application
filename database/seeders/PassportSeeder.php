<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Artisan;
class PassportSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('passport:install', ['--no-interaction' => true]);
    }
}
