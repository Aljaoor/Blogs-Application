<?php

namespace App\View\Components\Layouts;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render(): View|Closure|string
    {

        $categories_orm = Category::withCount(['posts' => function ($query) {
            $query->where('active', true);
        }])
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();
//select `categories`.*,
// (select count(*) from `posts` inner join `category_posts` on `posts`.`id` = `category_posts`.`post_id` where `categories`.`id` = `category_posts`.`category_id` and `active` = ?)
// as `posts_count` from `categories`
// order by `posts_count` desc limit

        $categories = Category::query()
            ->join('category_posts', 'categories.id', '=', 'category_posts.category_id')
            ->join('posts', 'category_posts.post_id', '=', 'posts.id')
            ->where('posts.active', true) // Filter active posts
            ->select('categories.name', \DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $tags = Tag::query()
            ->join('post_tags', 'tags.id', '=', 'post_tags.tag_id')
            ->join('posts', 'post_tags.post_id', '=', 'posts.id')
            ->where('posts.active', true) // Filter active posts
            ->select('tags.id','tags.name', \DB::raw('count(*) as total'))
            ->groupBy('tags.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('components.layouts.sidebar', compact('categories','tags'));
    }
}
