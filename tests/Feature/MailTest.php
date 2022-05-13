<?php

namespace Tests\Feature;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Services\SubscriptionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    public function testMailCanBeSent(): void
    {
        $this->seed();

        Mail::fake();

        $post = Post::factory()->website(1)->createOne();

        SubscriptionService::sendEmailToSubscribers($post);

        Mail::assertSent(PostPublished::class);
    }
}
