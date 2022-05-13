<?php

namespace Tests\Feature;

use App\Events\PostPublishedEvent;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanPublishPost(): void
    {
        $user = User::factory()->createOne();
        $website = Website::factory()->createOne();
        $post = Post::factory()->makeOne()->toArray();

        Sanctum::actingAs($user);

        $response = $this->post("api/websites/$website->id/posts", $post);

        $response->assertCreated();

        $this->assertDatabaseHas(Post::class, [
            'id' => $response->json('data.id'),
            'title' => $post['title'],
            'website_id' => $website->id,
            'writer_id' => $user->id,
        ]);
    }

    public function testEventDispatchedAfterPublishingPost(): void
    {
        Event::fake();

        $user = User::factory()->createOne();
        $website = Website::factory()->createOne();
        $post = Post::factory()->makeOne()->toArray();

        Sanctum::actingAs($user);

        $this->post("api/websites/$website->id/posts", $post);

        Event::assertDispatched(PostPublishedEvent::class);
    }
}
