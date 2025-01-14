<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // Registration Method
    public function register(Request $request)
    {
        // Validate the request on the frontend to catch basic errors early
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        // Send the registration data to the API, including password_confirmation
        $response = Http::post('http://api_nginx/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
    
        // Handle the API response
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Kayıt Başarılı!');
        }
        
    
        // Return errors from the API if the request fails
        return redirect()->back()->withErrors(
            $response->json('errors') ?? ['api_error' => 'Kayıt Başarısız.']
        );
    }
    

    // Login Method
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Send login request to backend
        $response = Http::post('http://api_nginx/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        // Debugging: Output response for testing
        // dd($response->json());
    
        // Check if login was successful
        if ($response->successful() && isset($response['token'])) {
            // Store token in session
            session([
                'api_token' => $response['token'],
            ]);
    
            return redirect()->route('product.index')->with('success', 'Giriş başarılı!');
        }
    
        // Handle login errors
        $errorMessage = $response->json('message') ?? 'Giriş başarısız.';
        return back()->withErrors(['login' => $errorMessage]);
    }
    
    

    // Logout Method
    public function logout()
    {
        // Send a logout request to the backend
        $response = Http::withToken(session('api_token'))->post('http://api_nginx/api/logout');
    
        // Clear session data
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
        // Add the user ID to the request payload
        $request['id'] = session('user')['id']; 
    
        // Send the request to the API
        $response = Http::acceptJson()
            ->withHeaders(['Authorization' => session('api_token')])
            ->put(env('API_URL').'/api/profile', $request->all()); 
    
        // Check if the update was successful
        if ($response->successful()) {
            // Update the session with the new user data
            session(['user' => $response->json('data')]);
    
            // Redirect with success message
            return redirect('/post')->with('status', 'Profiliniz başarıyla güncellendi.');
        }
    
        // Handle API errors
        return redirect('/post')->withErrors(['update' => 'Profil güncellemesi başarısız.']);
    }
    
    
}
