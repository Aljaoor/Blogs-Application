<?php

namespace Database\Seeders;

use App\Models\TextWidget;
use Illuminate\Database\Seeder;

class TextWidgetsSeeder extends Seeder
{
    public function run(): void
    {
        TextWidget::create([
            'key' => 'about-me',
            'image' =>  'https://via.placeholder.com/640x480.png/00dd88?text=sport+dolorum',
            'title' => 'about me',
            'content' => '<p><em>This application was developed by Engineer Mohammed Aljaoor. It is a mobile application, a website, and an admin panel programmed using Laravel and Filament. It includes an authentication and Permissions system.</em></p>',
            'active' => true,
        ]);

        TextWidget::create([
            'key' => 'about-us',
            'image' =>  '01HSCHJ0AY298T3RVHSRH75SPB.png',
            'title' => 'About Us',
            'content' => '<p><em>This application was developed by Engineer Mohammed Aljaoor. It is a mobile application, a website, and an admin panel programmed using Laravel and Filament. It includes an authentication and Permissions system.</em></p>',
            'active' => true,
        ]);
    }
}
