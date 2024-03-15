<?php

namespace App\Repositories;

use App\Models\categories;
use App\Repositories\BaseRepository;

class categoriesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return categories::class;
    }
}
