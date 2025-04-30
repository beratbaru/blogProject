@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center">
    <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-8 shadow-xl">
        <h3 class="text-2xl font-bold text-white mb-6">Lütfen önce giriş yapınız.</h3>
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
    <header class="sticky top-0 bg-gray-800 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-50 transition-colors duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-2xl font-light text-amber-600 dark:text-amber-400">Blog</a>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('profile') }}" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">
                        <i class="fas fa-user-circle text-xl mr-2"></i>
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                            <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                            Çıkış Yap
                        </button>
                    </form>
                </div>

                <button id="menuButton" class="md:hidden text-gray-700 dark:text-gray-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <div id="mobileMenu" class="md:hidden hidden mt-4 bg-white dark:bg-gray-700 rounded-lg p-4 shadow-lg border border-gray-200 dark:border-gray-600">
                <a href="{{ url('profile') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">
                    <i class="fas fa-user-circle text-xl mr-2"></i>
                    Profil
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                        Çıkış Yap
                    </button>
                </form>
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
<section class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
        
            <div class="bg-gradient-to-r from-blue-1000 to-purple-1000 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-100">Profil Bilgileri</h1>
                    <a href="{{ route('post.index') }}" 
                       class="flex items-center text-gray-300 hover:text-blue-200 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
                <p class="mt-1 text-sm text-blue-200">Profilinizi güncelleyin</p>
            </div>

            <div class="px-6 py-8">
                <form action="{{ route('profile.update', $profile['id']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-300 mb-2">İsim Soyisim</label>
                        <input type="text" name="name" id="name" 
                               class="w-full rounded-lg bg-gray-700 border border-gray-600 
                                      text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-900
                                      p-3 @error('name') border-red-500 @enderror"
                               placeholder="İsminizi giriniz" 
                               value="{{ old('name', $profile['name']) }}">
                        @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-300 mb-2">E-posta</label>
                        <input type="email" name="email" id="email" 
                               class="w-full rounded-lg bg-gray-700 border border-gray-600 
                                      text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-900
                                      p-3 @error('email') border-red-500 @enderror"
                               placeholder="E-posta adresinizi giriniz" 
                               value="{{ old('email', $profile['email']) }}">
                        @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Yeni Şifre</label>
                        <input type="password" name="password" id="password" 
                               class="w-full rounded-lg bg-gray-700 border border-gray-600 
                                      text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-900
                                      p-3 @error('password') border-red-500 @enderror"
                               placeholder="Yeni şifrenizi giriniz">
                        @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-1000 to-purple-1000 
                                       text-white py-3 px-6 rounded-lg font-semibold
                                       hover:from-blue-800 hover:to-purple-800 transition-all
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

document.addEventListener('click', function(event) {
    const menuButton = document.getElementById('menuButton');
    const dropdown = document.getElementById('menuDropdown');
    
    if (!menuButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endsection