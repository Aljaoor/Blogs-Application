<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Collection;
class AppLayout extends Component
{
    public Collection $categories;
    public function __construct(public ?string $metaTitle = null, public ?string $metaDescription = null)
    {
        $this->categories = Category::query()
            ->join('category_posts', 'categories.id', '=', 'category_posts.category_id')
            ->join('posts', 'category_posts.post_id', '=', 'posts.id')
            ->where('posts.active', true) // Filter active posts
            ->select('categories.name', \DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }
    public function render(): View
    {
        return view('layouts.app');
    }
}
