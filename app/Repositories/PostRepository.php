<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'author_id',
        'title',
        'slug',
        'image',
        'description',
        'published_at',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Post::class;
    }
}
