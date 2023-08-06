<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function store(PostStoreRequest $request)
    {
        $validated = $request->safe();

        $validated = $validated->merge([
            'user_id' => $request->user()->id,
        ]);

        $post = Post::query()->create($validated->toArray());

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return new PostResource($post);
    }
}