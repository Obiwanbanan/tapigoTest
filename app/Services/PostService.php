<?php

namespace App\Services;

use App\DTO\PostDTO;
use App\Models\Post;

class PostService
{
    public function updateOrCreatePost(PostDTO $DTO, int $id = null): Post
    {
        $post = $id !== null
            ? Post::findOrFail($id)
            : new Post();

        $post->title = $DTO->getTitle();
        $post->content = $DTO->getContent();
        $post->save();

        return $post;
    }
}
