<?php

namespace App\Http\Controllers;

use App\Events\PostPublishedEvent;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Website;

class PostController extends Controller
{
    public function store(StorePostRequest $request, Website $website)
    {
        $post = Post::create($request->validated() + [
                'writer_id' => auth()->id(),
                'website_id' => $website->id,
            ]);

        PostPublishedEvent::dispatch($post);

        return new PostResource($post);
    }
}
