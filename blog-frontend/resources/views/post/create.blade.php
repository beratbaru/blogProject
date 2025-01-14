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
            <h4 class="text-xl font-semibold">Ürün Oluştur</h4>
            <a href="{{ route('product.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Geri</a>
        </div>
        <div class="p-6">
            <form action="{{ route('product.store') }}" method="POST" id="createProductForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Ürün Adı</label>
                    <input type="text" name="product_name" class="w-full px-4 py-2 border rounded-lg" value="{{ old('product_name') }}" required />
                    @error('product_name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Ürün Açıklaması</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg" required>{{ old('description') }}</textarea>
                    @error('description') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Fiyat</label>
                    <input type="text" name="product_price" class="w-full px-4 py-2 border rounded-lg" value="{{ old('product_price') }}" required />
                    @error('product_price') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kaydet</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
