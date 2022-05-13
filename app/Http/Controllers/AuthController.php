<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken(mb_substr($request->userAgent(), 0, 255))->plainTextToken;

        return response()->json([
            'data' => [
                'access_token' => $token,
            ],
            'message' => 'Register successful.',
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $user = User::firstWhere('email', $request->input('email'));

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Wrong email or password.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $user->createToken(mb_substr($request->userAgent(), 0, 255))->plainTextToken;

        return response()->json([
            'data' => [
                'access_token' => $token,
            ],
            'message' => 'Login successful.',
        ]);
    }
}
