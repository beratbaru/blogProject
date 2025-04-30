<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Kullanıcı bulunamadı.'
            ], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Şifre eşleşmiyor.'
            ], 401);
        }
        $token = $user->createToken($user->name . '-Auth-Token')->plainTextToken;
        return response()->json([
            'message' => 'Giriş başarılı.',
            'token_type' => 'Bearer',
            'token' => 'Bearer ' . $token,
            'user' => $user
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
            return response()->json([
                'message' => 'Kayıt başarılı.',
            ], 201);
        }
    
        return response()->json([
            'message' => 'Bir şeyler ters gitti, lütfen tekrar deneyin.',
        ], 500);
    }
    
    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user && $user->token()) {
            $user->token()->revoke();
            return response()->json(['message' => 'Logout successful'], 200);
        }
        return response()->json(['message' => 'Token invalid or user not authenticated'], 401);
    }
    

    public function profile(Request $request)
    {
        if ($request->user()) {
            return response()->json([
                'message' => 'Profile fetched successfully.',
                'data' => $request->user(),
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated.',
        ], 401);
    }
}
