<?php

namespace App\Http\Controllers\Auth;

use App\BusinessObject\AuthBO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthBO $authBO) {}

    /*
    * Handle an incoming registration request.
    */
    public function register (RegisterRequest $request)
    {
        $user = $this->authBO->register($request->validated());

        return response()->json($user, 201);
    }

    /*
    * Handle an incoming login request.
    */
    public function login (LoginRequest $request)
    {
        $token = $this->authBO->login($request->email, $request->password);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /*
    * Handle an incoming logout request.
    */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
