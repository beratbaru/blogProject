@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="flex items-center justify-center bg-gray-100 text-gray-800 fixed top-0 left-0 right-0 z-50 py-4">
    <div class="text-center w-full">
        <h3 class="text-lg font-bold">Verileri görmek için giriş yapınız.</h3>
        <div class="mt-4 flex justify-center gap-4">
            <a href="{{ route('register') }}" class="px-6 py-2 text-blue-600 font-medium rounded-md hover:bg-blue-100 transition duration-300">
                <span class="inline md:hidden">+</span>
                <span class="hidden md:inline">Kayıt Ol</span>
            </a>
            <a href="{{ route('login') }}" class="px-6 py-2 text-gray-600 font-medium rounded-md hover:bg-gray-100 transition duration-300">
                <span class="inline md:hidden">→</span>
                <span class="hidden md:inline">Giriş Yap</span>
            </a>
        </div>
    </div>
</div>
<!-- Add margin to the top of the content to avoid overlap -->
<div class="mt-[80px]"></div> 
@else
<div class="container mx-auto p-4">
    <div class="sticky top-0 bg-gray-100 z-10 py-3 border-b">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-semibold">Blog</h4>
            <div class="flex items-center">
                <div class="md:hidden relative">
                    <button class="text-gray-600 text-2xl" id="menuButton">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="absolute top-full right-0 bg-white shadow-md mt-2 rounded-md hidden" id="menuDropdown">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block px-6 py-2 text-left w-full hover:bg-gray-200 rounded-md">
                                <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                            </button>
                        </form>

                    </div>
                </div>
                <div class="hidden md:flex gap-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 text-xl hover:text-gray-800">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                    <a href="{{ url('profile') }}" class="text-gray-600 text-xl hover:text-gray-800">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('status'))
    <div class="mt-4 p-4 bg-green-500 text-white rounded-md">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-12">
        @if(empty($posts) || count($posts) === 0)
        <div class="col-span-full text-center py-4">Yazı bulunamadı.</div>
        @else
        @foreach ($posts as $post)
        <div class="bg-white shadow-lg rounded-md p-4 flex flex-col justify-between relative">
            <div>
                <h5 class="text-lg font-bold mb-2">{{ $post['image'] }}</h5>
                <p class="text-gray-600 mb-4">{{ $post['title'] }}</p>
            </div>
            <div class="mt-auto">
                <p class="text-gray-800 font-semibold mb-4">{{ $post['content'] }}</p>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 flex flex-col gap-4">
                    <!-- Edit Button (Icon) -->
                    <a href="{{ route('post.edit', $post['id']) }}" class="text-xl">
                        <i class="fas fa-edit"></i>
                    </a>
                    <!-- Show Button (Icon) -->
                    <a href="{{ route('post.show', $post['id']) }}" class="text-xl">
                        <i class="fas fa-eye"></i>
                    </a>
                    <!-- Delete Button (Icon) -->
                    <form action="{{ route('post.destroy', $post['id']) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xl">
                            <i class="fas fa-trash-alt" style="width:22px"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    @if (!empty($paginationLinks) && isset($totalposts) && $totalposts > 10)
    <div class="flex justify-center mt-4 items-center">
        @if ($paginationLinks['previous'])
        <a href="{{ url()->current() . '?' . parse_url($paginationLinks['previous'], PHP_URL_QUERY) }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300">Geri</a>
        @else
        <button class="px-6 py-2 bg-gray-300 text-gray-500 rounded-md" disabled>Geri</button>
        @endif

        @if (isset($currentPage) && isset($totalPages))
        <span class="mx-3">Sayfa {{ $currentPage }} / {{ $totalPages }}</span>
        @endif

        @if ($paginationLinks['next'])
        <a href="{{ url()->current() . '?' . parse_url($paginationLinks['next'], PHP_URL_QUERY) }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300">İleri</a>
        @else
        <button class="px-6 py-2 bg-gray-300 text-gray-500 rounded-md" disabled>İleri</button>
        @endif
    </div>
    @endif
</div>
@endif

<script>
document.getElementById('menuButton').addEventListener('click', function() {
    const dropdown = document.getElementById('menuDropdown');
    dropdown.classList.toggle('hidden');
});
</script>
@endsection
