<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $table = 'posts';

    public $fillable = [
        'author_id',
        'title',
        'slug',
        'image',
        'description',
        'published_at',
        'active'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'image' => 'string',
        'description' => 'string',
        'published_at' => 'string',
        'active' => 'boolean'
    ];

    public static array $rules = [
        'author_id' => 'required|exists:users,id|',
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'image' => 'required|image|max:1024',
        'description' => 'required|string',
        'published_at' => 'required|date',
        'active' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'categories' => 'required|array',
        'categories.*' => 'integer|exists:categories,id',
        'tags' => 'array',
        'tags.*' => 'integer|exists:tags,id'

    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
