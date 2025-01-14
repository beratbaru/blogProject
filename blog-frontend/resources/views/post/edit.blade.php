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
            <h4 class="text-xl font-semibold">Ürün Düzenle</h4>
            <a href="{{ route('post.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Geri</a>
        </div>
        <div class="p-6">
            <form action="{{ route('post.update', $post['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="image" class="block text-sm font-semibold">Ürün Adı</label>
                    <input type="text" name="image" class="w-full px-4 py-2 border rounded-lg" value="{{ old('image', $post['image']) }}">
                    @error('image')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-semibold">Fiyat</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border rounded-lg" value="{{ old('title', $post['title']) }}">
                    @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-semibold">Açıklama</label>
                    <textarea name="content" class="w-full px-4 py-2 border rounded-lg">{{ old('content', $post['content']) }}</textarea>
                    @error('content')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
