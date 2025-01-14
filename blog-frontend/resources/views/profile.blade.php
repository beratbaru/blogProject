@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="flex justify-center items-center min-h-screen bg-gray-900 text-red-500">
    <div class="text-center">
        <h3 class="text-2xl">Verileri görmek için giriş yapınız.</h3>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Kayıt Ol</a>
            <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Giriş Yap</a>
        </div>
    </div>
</div>
@else

<section class="py-10 min-h-screen flex items-center justify-center dark:bg-gray-900">
    <div class="lg:w-[80%] md:w-[90%] xs:w-[96%] mx-auto flex gap-4 relative">
        <!-- Left Arrow Button -->
        <a href="{{ route('post.index') }}" class="absolute sm:relative left-0 top-0 mt-4 ml-4 text-3xl text-white hover:text-gray-400 sm:ml-0 sm:mt-0">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div class="lg:w-[88%] md:w-[80%] sm:w-[88%] xs:w-full mx-auto shadow-2xl p-4 rounded-xl h-fit self-center dark:bg-gray-800/40">
            <div>
                <h1 class="lg:text-3xl md:text-2xl sm:text-xl xs:text-xl font-serif font-extrabold mb-2 dark:text-white">
                    Profil
                </h1>
                <h2 class="text-grey text-sm mb-4 dark:text-gray-400">Profil Düzenleme</h2>
                <form action="{{ route('profile.update', $profile['id'])}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="w-full mb-4">
                        <label for="name" class="mb-2 dark:text-gray-300">İsim Soyisim</label>
                        <input type="text" name="name" id="name"
                               class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800"
                               placeholder="İsminizi giriniz." value="{{ old('name', $profile['name']) }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full mb-4">
                        <label for="email" class="mb-2 dark:text-gray-300">Mail</label>
                        <input type="email" name="email" id="email"
                               class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800"
                               placeholder="Mailinizi giriniz." value="{{ old('email', $profile['email']) }}">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full mb-4">
                        <label for="password" class="mb-2 dark:text-gray-300">Yeni Şifre</label>
                        <input type="password" name="password" id="password"
                               class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800"
                               placeholder="Yeni şifrenizi giriniz.">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full rounded-lg bg-blue-500 mt-4 text-white text-lg font-semibold">
                        <button type="submit" class="w-full p-4">Onayla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
