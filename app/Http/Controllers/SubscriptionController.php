<?php

namespace App\Http\Controllers;

use App\Models\UserWebsite;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    public function store(Website $website): JsonResponse
    {
        $userId = auth()->id();

        if ($website->isSubscribed($userId)) {
            return response()->json([
                'message' => 'You are already subscribed to this website.',
            ], Response::HTTP_BAD_REQUEST);
        }

        UserWebsite::create([
            'user_id' => $userId,
            'website_id' => $website->id,
        ]);

        return response()->json([
            'message' => 'Subscription successful.',
        ], Response::HTTP_CREATED);
    }
}
