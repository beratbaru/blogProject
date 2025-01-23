{{-- show.blade.php --}}
@extends('layouts.frontend')

@section('content')

<div class="container mx-auto mt-8">
    <!-- Post Section -->
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-gray-800 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h4 class="text-xl font-semibold">{{ $post['title'] ?? 'Post Title' }}</h4>
            <a href="{{ route('post.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Geri</a>
        </div>
        <div class="p-6">
            <p class="text-gray-800">{{ $post['content'] ?? 'Post description' }}</p>
            <img class="text-gray-600 mt-2" src="{{ 'http://' . env('API_URL') . '/storage/' . $post['image'] }}" alt="Post Image">
        </div>
    </div>

    <!-- Comment Section -->
    <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-gray-800">Yorumlar</h3>

        <!-- Existing Comments -->
        @if (!empty($comments) && is_array($comments))
            <div class="mt-4 space-y-4">
                @foreach ($comments as $comment)
                    <div class="bg-white p-4 rounded shadow-md">
                        <p class="text-gray-800 font-semibold">{{ $comment['user']['name'] ?? 'Anonymous' }}</p>
                        <p class="text-gray-600 mt-2">{{ $comment['content'] }}</p>
                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Yorum Yok.</p>
        @endif

        <!-- Add Comment Form -->
        <form action="{{ route('comments.store', $postId) }}" method="POST">
            @csrf
            <textarea name="content" class="w-full mt-4 border rounded p-2" placeholder="Yorum yaz..." required></textarea>
            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Gönder</button>
        </form>
    </div>
</div>

@endsection
