<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $response = ApiRequest::request('post', '/api/register', $request->all())
;
        
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
        
        if ($response->successful()) {
            session()->forget(['api_token', 'user_name', 'user']);
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yapıldı.');
        }
        
        return redirect()->route('login')->withErrors(['logout' => 'Çıkış sırasında bir hata oluştu.']);
    }

    public function show(){
        $response = ApiRequest::request('get' , '/api/profile', request()->query());
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
        $response = ApiRequest::request('put' , '/api/profile' , $request->all());
    
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
    
        $response = ApiRequest::request('post', '/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        $responseData = $response->json();

        if ($response->successful() && isset($responseData['data']['token'])) {
            session([
                'api_token' => $responseData['data']['token'],
                'user' => $responseData['data']['user'],
            ]);
    
            return redirect()->route('post.index')->with('success', 'Giriş başarılı!');
        }
    
        $errorMessage = $response->json('message') ?? 'Giriş başarısız.';
        return back()->withErrors(['login' => $errorMessage]);
    }
    
}
