@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center px-4">
    <div class="max-w-md w-full text-center bg-white rounded-2xl p-8 shadow-xl">
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">Blog</h1>
            <p class="text-gray-600">Sitemize erişebilmek için giriş yapmanız gerekmektedir.</p>
        </div>
        <div class="space-y-4">
            <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition duration-300">
                Kayıt Ol
            </a>
            <a href="{{ route('login') }}" class="block w-full border-2 border-blue-500 text-blue-600 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
                Giriş Yap
            </a>
        </div>
    </div>
</div>
@else
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
<header class="sticky top-0 bg-white/80 backdrop-blur-md border-b z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="#" class="text-2xl font-bold text-blue-600">Blog</a>
            
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

        <!-- Dropdown Menu for Mobile -->
        <div id="mobileMenu" class="md:hidden hidden mt-4">
            <a href="{{ url('profile') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">
                <i class="fas fa-user-circle text-xl mr-2"></i>
                Profil
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block py-2 text-gray-600 hover:text-red-600 transition-colors">
                    <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                    Çıkış Yap
                </button>
            </form>
        </div>
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        menuButton.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
    <!-- Categories Navigation (Sticky) -->
    <nav class="sticky top-16 bg-white shadow-md z-40 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex overflow-x-auto space-x-4">
            <!-- Link to show all posts -->
            <a href="{{ route('post.index') }}"
               class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap
               {{ !request()->has('category_id') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800' }}">
                Tümü
            </a>
            @foreach($categories as $category)
                <a href="{{ route('post.index', ['category_id' => $category['id']]) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap
                   {{ request('category_id') == $category['id'] ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800' }}">
                    {{ $category['name'] }}
                </a>
            @endforeach
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('status'))
        <div class="mb-8 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($posts as $post)
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Featured Image -->
                <div class="relative h-48 overflow-hidden">
                    <a href="{{ route('post.show', $post['id']) }}">
                        <img src="{{ 'http://'.env('API_URL').'/storage/'.$post['image'] }}" 
                             alt="Post image" 
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                    </a>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post['title'] }}</h3>
                    <p class="text-gray-600 line-clamp-3 mb-4">{{ $post['content'] }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-comment mr-2"></i>
                            @if($post['comments_count']>=1)
                            {{ $post['comments_count'] ?? 0 }} yorum
                            @endif
                        </span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-500 text-xl mb-4">
                    <i class="fas fa-file-alt text-4xl mb-4"></i>
                    <p>Yazı bulunamadı. Hemen bir tane oluştur!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($paginationLinks) && isset($totalposts) && $totalposts > 6)
        <div class="mt-12 flex justify-center space-x-4">
            @if ($paginationLinks['previous'])
            <a href="{{ url()->current() . '?' . parse_url($paginationLinks['previous'], PHP_URL_QUERY) }}" 
               class="px-5 py-2 bg-white border rounded-lg hover:bg-blue-50 text-blue-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
            </a>
            @endif

            @if(isset($currentPage) && isset($totalPages))
            <div class="px-5 py-2 bg-blue-600 text-white rounded-lg">
                {{ $currentPage }} / {{ $totalPages }}
            </div>
            @endif

            @if ($paginationLinks['next'])
            <a href="{{ url()->current() . '?' . parse_url($paginationLinks['next'], PHP_URL_QUERY) }}" 
               class="px-5 py-2 bg-white border rounded-lg hover:bg-blue-50 text-blue-600 flex items-center">
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
            @endif
        </div>
        @endif
    </main>
</div>
@endif
@endsection
