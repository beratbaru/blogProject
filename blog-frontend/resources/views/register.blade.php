@extends('layouts.frontend')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <h3 class="text-xl font-semibold text-gray-700 text-center">Kayıt ol</h3>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-md">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div>
                <input type="text" 
                       name="name" 
                       required 
                       placeholder="İsminizi girin" 
                       value="{{ old('name') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div>
                <input type="email" 
                       name="email" 
                       required 
                       placeholder="Mailinizi girin" 
                       value="{{ old('email') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div>
                <input type="password" 
                       name="password" 
                       required 
                       placeholder="Şifrenizi girin" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div>
                <input type="password" 
                       name="password_confirmation" 
                       required 
                       placeholder="Şifrenizi doğrulayın" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div>
                <input type="submit" 
                       name="submit" 
                       value="kayıt ol" 
                       class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 cursor-pointer">
            </div>

            <p class="text-center text-gray-600">
                Zaten hesabın var mı? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">giriş yap</a>
            </p>
        </form>
    </div>
</div>
