<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $response = Http::post('http://api_nginx/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        if ($response->successful() && isset($response['token'])) {
            session([
                'api_token' => $response['token'], 'user' => $response['user'],
                
            ]);
    
            return redirect()->route('post.index')->with('success', 'Giriş başarılı!');
        }
    
        $errorMessage = $response->json('message') ?? 'Giriş başarısız.';
        return back()->withErrors(['login' => $errorMessage]);
    }
}
