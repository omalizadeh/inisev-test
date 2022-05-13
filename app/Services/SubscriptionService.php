<?php

namespace App\Services;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class SubscriptionService
{
    public static function sendEmailToSubscribers(Post $post): void
    {
        $users = User::whereHas('websites', function (Builder $query) use ($post) {
            $query->where('id', $post->id);
        })->get();

        Mail::to($users)->send(new PostPublished($post));
    }
}
