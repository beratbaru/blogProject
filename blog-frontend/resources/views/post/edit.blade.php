@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
@include('partials.auth-alert')
@else
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Gönderiyi Düzenle</h2>
                    <a href="{{ route('post.index') }}" 
                       class="flex items-center text-white hover:text-blue-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
            </div>

            <!-- Form Body -->
            <div class="px-6 py-8 space-y-8">
                <form action="{{ route('post.update', $post['id']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Image URL -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Resim URL</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="image" value="{{ old('image', $post['image']) }}"
                                   class="form-input block w-full rounded-lg border-gray-300 
                                          focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                          transition duration-200 @error('image') border-red-500 @enderror">
                            @error('image')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            @enderror
                        </div>
                        @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Başlık</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="title" value="{{ old('title', $post['title']) }}"
                                   class="form-input block w-full rounded-lg border-gray-300 
                                          focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                          transition duration-200 @error('title') border-red-500 @enderror">
                            @error('title')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            @enderror
                        </div>
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">İçerik</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <textarea name="content" rows="6"
                                      class="form-textarea block w-full rounded-lg border-gray-300 
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                             transition duration-200 @error('content') border-red-500 @enderror">{{ old('content', $post['content']) }}</textarea>
                        </div>
                        @error('content')
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
                            Değişiklikleri Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection