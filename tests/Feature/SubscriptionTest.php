<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserWebsite;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanSubscribeWebsite(): void
    {
        $user = User::factory()->createOne();
        $website = Website::factory()->createOne();

        Sanctum::actingAs($user);

        $response = $this->post("api/websites/$website->id/subscribe");

        $response->assertCreated();

        $this->assertDatabaseHas(UserWebsite::class, [
            'website_id' => $website->id,
            'user_id' => $user->id,
        ]);
    }
}
