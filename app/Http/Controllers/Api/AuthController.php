<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    // Login de usuario
    public function login(Request $request) {

        // $credentials = $request->only('email', 'password');
        // return 'publico';

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'error' => true,
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'error' => false,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    // Logout de usuario
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'error' => false,
            'message' => 'Successfully logged out'
        ]);
    }
}
