@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center">
    <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-8 shadow-xl">
        <h3 class="text-2xl font-bold text-white mb-6">Verileri görmek için giriş yapınız.</h3>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" 
               class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all transform hover:scale-105">
                Kayıt Ol
            </a>
            <a href="{{ route('login') }}" 
               class="px-6 py-2 border-2 border-blue-500 text-blue-500 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                Giriş Yap
            </a>
        </div>
    </div>
</div>
@else
    <!-- Header -->
    <header class="sticky top-0 bg-white/80 backdrop-blur-md border-b z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/posts" class="text-2xl font-bold text-blue-600">Blog</a>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('profile') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="fas fa-user-circle text-xl mr-2"></i>
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                            Çıkış Yap
                        </button>
                    </form>
                </div>

                <button id="menuButton" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
    </header>

    <div id="menuDropdown" class="md:hidden absolute right-0 w-48 bg-white shadow-lg rounded-lg py-2 mt-2 hidden">
        <a href="{{ url('profile') }}" class="block px-6 py-3 hover:bg-gray-100">
            <i class="fas fa-user-circle mr-3"></i>Profil
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full text-left px-6 py-3 hover:bg-gray-100 text-red-600">
                <i class="fas fa-sign-out-alt mr-3"></i>Çıkış yap
            </button>
        </form>
    </div>
<section class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">Profil Bilgileri</h1>
                    <a href="{{ route('post.index') }}" 
                       class="flex items-center text-white hover:text-blue-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
                <p class="mt-1 text-sm text-blue-100">Profilinizi güncelleyin</p>
            </div>

            <!-- Form -->
            <div class="px-6 py-8">
                <form action="{{ route('profile.update', $profile['id']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">İsim Soyisim</label>
                        <input type="text" name="name" id="name" 
                               class="form-input block w-full rounded-lg border-gray-300 
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                      transition duration-200 @error('name') border-red-500 @enderror"
                               placeholder="İsminizi giriniz" 
                               value="{{ old('name', $profile['name']) }}">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                        <input type="email" name="email" id="email" 
                               class="form-input block w-full rounded-lg border-gray-300 
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                      transition duration-200 @error('email') border-red-500 @enderror"
                               placeholder="E-posta adresinizi giriniz" 
                               value="{{ old('email', $profile['email']) }}">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Yeni Şifre</label>
                        <input type="password" name="password" id="password" 
                               class="form-input block w-full rounded-lg border-gray-300 
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                      transition duration-200 @error('password') border-red-500 @enderror"
                               placeholder="Yeni şifrenizi giriniz">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 
                                       text-white py-3 px-6 rounded-lg font-semibold
                                       hover:from-blue-700 hover:to-purple-700 transition-all
                                       transform hover:scale-[1.01] shadow-md">
                            Bilgileri Güncelle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endif
<script>
document.getElementById('menuButton').addEventListener('click', function() {
    const dropdown = document.getElementById('menuDropdown');
    dropdown.classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const menuButton = document.getElementById('menuButton');
    const dropdown = document.getElementById('menuDropdown');
    
    if (!menuButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endsection