@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<!-- ... existing guest content remains the same ... -->
@else
<header class="sticky top-0 bg-gray-800/80 backdrop-blur-md border-b border-gray-700 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/posts" class="text-2xl font-bold text-blue-400">Blog</a>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('profile') }}" class="flex items-center text-gray-300 hover:text-blue-400 transition-colors">
                    <i class="fas fa-user-circle text-xl mr-2"></i>
                    Profil
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-gray-300 hover:text-red-400 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                        Çıkış Yap
                    </button>
                </form>
            </div>

            <button id="menuButton" class="md:hidden text-gray-300">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </nav>
</header>

<div id="menuDropdown" class="md:hidden absolute right-0 w-48 bg-gray-800 shadow-xl rounded-lg py-2 mt-2 hidden border border-gray-700">
    <a href="{{ url('profile') }}" class="block px-6 py-3 hover:bg-gray-700 text-gray-300">
        <i class="fas fa-user-circle mr-3"></i>Profil
    </a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="block w-full text-left px-6 py-3 hover:bg-gray-700 text-red-400">
            <i class="fas fa-sign-out-alt mr-3"></i>Çıkış yap
        </button>
    </form>
</div>

<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-8">
        @if(session('success'))
            <div class="bg-green-900/30 border-l-4 border-green-600 text-green-300 p-4 rounded-lg">
                <p class="font-bold">Başarılı!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <article class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
            <div class="bg-gradient-to-r from-blue-1000 to-purple-1000 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-100">{{ $post['title'] }}</h1>
                    <a href="{{ route('post.index') }}" 
                       class="flex items-center text-gray-300 hover:text-blue-200 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
            </div>

            <div class="px-6 py-8 space-y-6">
                <div class="prose max-w-none">
                    <p class="text-gray-300 leading-relaxed">{{ $post['content'] }}</p>
                </div>
                <div class="rounded-xl overflow-hidden shadow-lg border border-gray-700">
                    <img src="{{ 'http://localhost:8000'.'/'.$post['image'] }}" 
                         alt="Gönderi görseli" 
                         class="w-full h-96 object-cover transform hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </article>

        <section class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700">
            <h2 class="text-2xl font-bold text-gray-100 mb-6 flex items-center">
                <i class="fas fa-comments mr-3 text-purple-900"></i> Yorumlar ({{ count($comments) }})
            </h2>

            <div class="space-y-6">
                @forelse ($comments as $comment)
                <div class="bg-gray-700 rounded-xl p-5 shadow-sm hover:bg-gray-600/50 transition-colors">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-purple-600 text-white 
                                      flex items-center justify-center">
                                {{ strtoupper(substr($comment['user']['name'] ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-100">
                                    {{ $comment['user']['name'] ?? 'Misafir Kullanıcı' }}
                                </h3>
                                <span class="text-sm text-gray-400">
                                    {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                                </span>
                            </div>
                            <p class="mt-2 text-gray-300">{{ $comment['content'] }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <p class="text-gray-400">Henüz yorum yok. İlk yorumu siz yapın!</p>
                </div>
                @endforelse
            </div>

            <form action="{{ route('comments.store', $postId) }}" method="POST" class="mt-8">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Yorumunuz</label>
                        <textarea name="content" rows="3" 
                                  class="w-full rounded-lg bg-gray-700 border border-gray-600 
                                         text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-900
                                         transition duration-200 p-3" 
                                  placeholder="Düşüncelerinizi paylaşın..." required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" 
                                class="inline-flex items-center bg-gradient-to-r from-blue-1000 to-purple-1000 
                                       text-white px-6 py-2 rounded-lg font-semibold
                                       hover:from-blue-800 hover:to-purple-800 transition-all
                                       transform hover:scale-[1.02] shadow-md">
                            <i class="fas fa-paper-plane mr-2"></i> Yorum Gönder
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endif
@endsection