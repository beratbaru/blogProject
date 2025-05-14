<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
    
        $user = User::where('email', $validated['email'])->first();
    
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return ApiResponse::error('Yanlış mail veya şifre.', 401);
        }
    
        $token = $user->createToken($user->name . '-Auth-Token')->plainTextToken;
    
        return ApiResponse::success([
            'token' => 'Bearer ' . $token,
            'user' => $user->only('id', 'name', 'email'),
            'login' => 'successful.'
        ], 200);
    }
    


    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            
        ]);
    
        if ($user) {
            return ApiResponse::success([
                'user' => $user,
                'registration' => 'succesful.'
            ],201);
        }
    
        return ApiResponse::error('Something went wrong.', 500);
    }
    


    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            return ApiResponse::success([], 'Logout successful');
        }
    
        return ApiResponse::error('Invalid token, please log in first', 401);
    }
    


    public function profile(Request $request)
    {
        if ($request->user()) {
            return ApiResponse::success($request->user(),200);
        }

        return ApiResponse::error('Unauthenticated.', 401);
    }

}
