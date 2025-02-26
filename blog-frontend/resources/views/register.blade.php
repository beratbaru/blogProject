@extends('layouts.frontend')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-50 to-purple-50">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md transform transition-all hover:scale-105">
    
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            <h3 class="text-2xl font-bold text-gray-800 text-center mb-6">Kayıt Ol</h3>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">İsim</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                        
                       placeholder="İsminizi girin" 
                       value="{{ old('name') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                <input  
                       name="email" 
                       id="email" 
                        
                       placeholder="E-postanızı girin" 
                       value="{{ old('email') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Şifre</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                        
                       placeholder="Şifrenizi girin" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Şifre Doğrulama</label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                        
                       placeholder="Şifrenizi tekrar girin" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <button type="submit" 
                        class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    Kayıt Ol
                </button>
            </div>

            <p class="text-center text-gray-600 text-sm">
                Zaten hesabınız var mı? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Giriş Yap</a>
            </p>
            
        </form>
    </div>
</div>
@endsection