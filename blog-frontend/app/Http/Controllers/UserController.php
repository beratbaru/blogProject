<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('services.api.url') . '/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Kayıt Başarılı!');
        }
        
    
        return redirect()->back()->withErrors(
            $response->json('errors') ?? ['api_error' => 'Kayıt Başarısız.']
        );
    }    

    public function logout()
    {
        $response = Http::withToken(session('api_token'))->post(config('services.api.url').'/api/logout');
    
        session()->forget(['api_token', 'user_name', 'user']);
    
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yapıldı.');
        }
    
        return redirect()->route('login')->withErrors(['logout' => 'Çıkış sırasında bir hata oluştu.']);
    }
    


    public function show(){
        $response = Http::withHeaders(['Authorization' => session('api_token')])
        ->get(config('services.api.url') . '/api/profile', request()->query());
        $profile = $response->json()['data'];
        if ($response->successful()){
            $user = session('user');
            return view(
                'profile', compact('profile', 'user')
            );
        }
    }

    public function update(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => session('api_token'),
            'Accept' => 'application/json',
        ])->put(config('services.api.url') . "/api/profile", $request->all());
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Profiliniz başarıyla güncellendi!');
        }
    
        return back()->withErrors($response->json('errors', ['Bilinmeyen bir hata oluştu.']))->withInput();
    }

    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'password' => 'string',
        ]);
    
        $response = Http::post(config('services.api.url').'/api/login', [
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
