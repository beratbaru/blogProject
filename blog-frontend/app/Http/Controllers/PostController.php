<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = $request->only(['category_id', 'tag']);
    
        $postResponse = Http::withHeaders([
            'Authorization' => session('api_token')
        ])->get(env('API_URL') . '/api/posts', $queryParams);
        $posts = $postResponse->json('data', []) ?? [];
        
        $paginationLinks = $postResponse->json()['links'] ?? [];
        $meta = $postResponse->json()['meta'] ?? [];
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['total_pages'] ?? 1;
        $totalPosts = $meta['total_posts'] ?? 0;
    
        $categories = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/categories')->json('data', []) ?? [];
    
        $tags = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/tags')->json('data', []) ?? [];
            
        return view('post.index', compact('posts', 'paginationLinks', 'currentPage', 'totalPages', 'totalPosts', 'categories', 'tags'));
    }
}
