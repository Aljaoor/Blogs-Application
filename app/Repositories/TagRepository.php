<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Tag::class;
    }
}
