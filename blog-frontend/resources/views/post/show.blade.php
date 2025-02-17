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

<!-- Dropdown Menu -->
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
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Başarılı!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Post Section -->
        
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Post Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">{{ $post['title'] ?? 'Gönderi Başlığı' }}</h1>
                    
                    <a href="{{ route('post.index') }}" 
                       class="flex items-center text-white hover:text-blue-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
            </div>

            <!-- Post Content -->
            <div class="px-6 py-8 space-y-6">
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $post['content'] ?? 'Gönderi içeriği' }}</p>
                </div>
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ 'http://localhost:8000'.'/'.$post['image'] }}" 
                         alt="Gönderi görseli" 
                         class="w-full h-96 object-cover transform hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <section class="bg-white rounded-2xl shadow-xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-comments mr-3 text-purple-600"></i> Yorumlar ({{ count($comments) }})
            </h2>

            <!-- Comment List -->
            <div class="space-y-6">
                @forelse ($comments as $comment)
                <div class="bg-gray-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-purple-600 text-white 
                                      flex items-center justify-center">
                                {{ strtoupper(substr($comment['user']['name'] ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-800">
                                    {{ $comment['user']['name'] ?? 'Misafir Kullanıcı' }}
                                </h3>
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                                </span>
                            </div>
                            <p class="mt-2 text-gray-600">{{ $comment['content'] }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <p class="text-gray-500">Henüz yorum yok. İlk yorumu siz yapın!</p>
                </div>
                @endforelse
            </div>

            <!-- Comment Form -->
            <form action="{{ route('comments.store', $postId) }}" method="POST" class="mt-8">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Yorumunuz</label>
                        <textarea name="content" rows="3" 
                                  class="form-textarea block w-full rounded-lg border-gray-300 
                                         focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                         transition duration-200" 
                                  placeholder="Düşüncelerinizi paylaşın..." required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" 
                                class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 
                                       text-white px-6 py-2 rounded-lg font-semibold
                                       hover:from-blue-700 hover:to-purple-700 transition-all
                                       transform hover:scale-[1.02] shadow-md">
                            <i class="fas fa-paper-plane mr-2"></i> Yorum Gönder
                        </button>
                    </div>
                    
                </div>
            </form>
        </section>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');

        menuButton.addEventListener('click', function () {
            menuDropdown.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!menuButton.contains(event.target) && !menuDropdown.contains(event.target)) {
                menuDropdown.classList.add('hidden');
            }
        });
    });
</script>
@endif
@endsection