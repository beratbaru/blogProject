@extends('layouts.frontend')

@section('content')

<header class="sticky top-0 bg-white/80 backdrop-blur-md border-b z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{url('/posts')}}" class="text-2xl font-bold text-blue-600">Blog</a>
            
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

<div class="container mx-auto p-6">
    @if(isset($error))
        <div class="alert alert-danger mb-4 bg-red-500 text-white p-4 rounded-md shadow-md">
            {{ $error }}
        </div>
    @else
        <div class="policy-section mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">KVKK</h2>
            <div class="policy-content bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <p class="text-gray-700 leading-relaxed">{!! nl2br(e($kvkk_policy)) !!}</p>
            </div>
        </div>
    @endif
</div>


@endsection