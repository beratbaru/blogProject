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

<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-gray-800 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h4 class="text-xl font-semibold">Ürün Detayı</h4>
            <a href="{{ route('post.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Geri</a>
        </div>
        <div class="p-6">
            <h5 class="text-xl font-semibold">{{ $post['image'] }}</h5>
            <p class="text-gray-700">{{ $post['title'] }}</p>
            <p class="text-lg font-semibold mt-4">Fiyat: {{ $post['content'] }}₺</p>
        </div>
    </div>
</div>

@endif

@endsection
