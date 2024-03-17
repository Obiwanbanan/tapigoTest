<?php

namespace App\Http\Controllers;

use App\DTO\PostDTO;
use App\Enums\PostResponseMessages;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::paginate(5));
    }

    public function store(PostRequest $request, PostService $service)
    {
        return PostResource::make(
            $service->updateOrCreatePost(
                new PostDTO(
                    title: $request->title,
                    content: $request->content,
                ))
        );
    }

    public function show(int $id)
    {
        return PostResource::make(Post::findOrFail($id));
    }

    public function update(
        PostRequest $request,
        int         $id,
        PostService $service,
    )
    {
        return PostResource::make(
            $service->updateOrCreatePost(
                new PostDTO(
                    title: $request->title,
                    content: $request->content,
                ),
                id: $id,
            )
        );
    }

    public function destroy(string $id)
    {
        Post::findOrFail($id)->delete();

        return new JsonResponse(
            data: PostResponseMessages::DESTROY_OK,
            status: Response::HTTP_OK,
        );
    }
}
