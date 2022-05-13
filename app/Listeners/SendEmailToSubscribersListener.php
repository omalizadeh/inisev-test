<?php

namespace App\Listeners;

use App\Events\PostPublishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class SendEmailToSubscribersListener implements ShouldQueue
{
    public function handle(PostPublishedEvent $event)
    {
        Artisan::call('email:website-subscribers',[
            'post_id' => $event->post->id,
        ]);
    }
}
