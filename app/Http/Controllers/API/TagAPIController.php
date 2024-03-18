<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagAPIRequest;
use App\Http\Requests\API\UpdateTagAPIRequest;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TagAPIController
 */
class TagAPIController extends AppBaseController
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
        $this->middleware(['auth:api','role:Author|Admin'])->only(['update', 'destroy','store']);


    }

    /**
     * Display a listing of the Tags.
     * GET|HEAD /tags
     */
    public function index(Request $request): JsonResponse
    {
        $tags = $this->tagRepository->paginate(10);

        return $this->sendResponse($tags->toArray(), 'Tags retrieved successfully');
    }

    /**
     * Store a newly created Tag in storage.
     * POST /tags
     */
    public function store(CreateTagAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $tag = $this->tagRepository->create($input);

        return $this->sendResponse($tag->toArray(), 'Tag saved successfully');
    }

    /**
     * Display the specified Tag.
     * GET|HEAD /tags/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        return $this->sendResponse($tag->toArray(), 'Tag retrieved successfully');
    }

    /**
     * Update the specified Tag in storage.
     * PUT/PATCH /tags/{id}
     */
    public function update($id, UpdateTagAPIRequest $request): JsonResponse
    {
        
        $input = $request->all();

        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        $tag = $this->tagRepository->update($input, $id);

        return $this->sendResponse($tag->toArray(), 'Tag updated successfully');
    }

    /**
     * Remove the specified Tag from storage.
     * DELETE /tags/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        $tag->delete();

        return $this->sendSuccess('Tag deleted successfully');
    }
}
