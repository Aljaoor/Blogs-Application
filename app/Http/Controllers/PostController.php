<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    public function index():View
    {

        $posts = Post::query()
            ->whereDate('published_at','<=', Carbon::now())
            ->Active(true)
            ->OrderBy('published_at','desc')
            ->paginate(5);
        return view('home',compact('posts'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Post $post)
    {
        if (!$post->active || $post->published_at >= Carbon::now()->addHour(15)){
            throw new NotFoundHttpException();
        }
        $next = Post::query()
            ->active( true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->active( true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

        return view('post.view', compact('post', 'prev', 'next'));

    }

    public function edit(Post $post)
    {
    }

    public function update(Request $request, Post $post)
    {
    }

    public function destroy(Post $post)
    {
    }

    public function byCategory(Category $category)
    {
        $posts = Post::query()
            ->join('category_posts', 'posts.id', '=', 'category_posts.post_id')
            ->where('category_posts.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $title = $category->name;
        return view('post.index', compact('posts', 'title'));

    }

    public function byTag(Tag $tag)
    {
        $posts = Post::query()
            ->join('post_tags', 'posts.id', '=', 'post_tags.post_id')
            ->where('post_tags.tag_id', '=', $tag->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $title = $tag->name;
        return view('post.index', compact('posts', 'tag' ,'title'));

    }


}
