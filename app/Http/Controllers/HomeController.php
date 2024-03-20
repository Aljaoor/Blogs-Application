<?php

namespace App\Http\Controllers;

use App\Models\TextWidget;

class HomeController extends Controller
{
    public function about()
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'about-us')
            ->where('active', '=', 1)
            ->first();

        return view('about-us', compact('widget'));
    }
}
