<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property string $published_at
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property PostTag[] $postTags
 * @property CategoryPost[] $categoryPosts
 * @property User $user
 */
class Post extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'slug', 'image', 'description', 'published_at', 'active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','post_tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_posts');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}
