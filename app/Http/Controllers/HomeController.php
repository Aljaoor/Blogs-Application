<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        return view('dashboard');
    }
}
