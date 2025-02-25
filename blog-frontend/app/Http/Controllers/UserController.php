<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $response = Http::post('http://api_nginx/api/register', [
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
        $response = Http::withToken(session('api_token'))->post('http://api_nginx/api/logout');
    
        session()->forget(['api_token', 'user_name', 'user']);
    
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yapıldı.');
        }
    
        return redirect()->route('login')->withErrors(['logout' => 'Çıkış sırasında bir hata oluştu.']);
    }
    


    public function show(){
        $response = Http::withHeaders(['Authorization' => session('api_token')])
        ->get(env('API_URL') . '/api/profile', request()->query());
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
        $request['id'] = session('user')['id']; 
    
        $response = Http::acceptJson()
            ->withHeaders(['Authorization' => session('api_token')])
            ->put(env('API_URL').'/api/profile', $request->all()); 
    
        if ($response->successful()) {
            session(['user' => $response->json('data')]);
    
            return redirect('/post')->with('status', 'Profiliniz başarıyla güncellendi.');
        }
    
        return redirect('/post')->withErrors(['update' => 'Profil güncellemesi başarısız.']);
    }
    
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
