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
    <!-- Header -->
    <header class="sticky top-0 bg-white/80 backdrop-blur-md border-b z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-2xl font-bold text-blue-600">Blog</a>
                
                <!-- Desktop Menu -->
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

                <!-- Mobile Menu Button -->
                <button id="menuButton" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Dropdown -->
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

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('status'))
        <div class="mb-8 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($posts as $post)
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Featured Image -->
                <div class="relative h-48 overflow-hidden">
                    <a href="{{ route('post.show', $post['id']) }}"><img src="{{ 'http://'.env('API_URL').'/storage/'.$post['image'] }}" 
                         alt="Post image" 
                         class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                         ></a>
                    <div class="absolute top-4 right-4 flex space-x-2">
                        <a href="{{ route('post.show', $post['id']) }}" 
                           class="bg-white/90 text-gray-600 p-2 rounded-full shadow-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post['title'] }}</h3>
                    <p class="text-gray-600 line-clamp-3 mb-4">{{ $post['content'] }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        {{-- Add post date here if available --}}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-comment mr-2"></i>
                        @if($post['comments_count']>=1)
                        {{ $post['comments_count'] ?? 0 }} yorum {{-- Display actual comment count --}}
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

<style>

</style>
@endsection