<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\post;
use Illuminate\Pagination\LengthAwarePaginator;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = $request->only(['category_id', 'tag']);
    
        $postResponse = Http::withHeaders([
            'Authorization' => session('api_token')
        ])->get(env('API_URL') . '/api/posts', $queryParams);
    
        $posts = $postResponse->json()['data'] ?? [];
        $paginationLinks = $postResponse->json()['links'] ?? [];
        $meta = $postResponse->json()['meta'] ?? [];
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['total_pages'] ?? 1;
        $totalPosts = $meta['total_posts'] ?? 0;
    
        $categories = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/categories')->json()['data'] ?? [];
    
        $tags = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/tags')->json()['data'] ?? [];
    
        return view('post.index', compact('posts', 'paginationLinks', 'currentPage', 'totalPages', 'totalPosts', 'categories', 'tags'));
    }
    
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->post(env('API_URL') . '/api/posts', $request->all());

        if ($response->successful()) {
            return redirect()->route('post.index')->with('success', 'post created successfully.');
        }

        return back()->withErrors($response->json()['errors'] ?? ['API error'])->withInput();
    }

    public function show($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->get(env('API_URL') . '/api/posts/'. $id, $request->all());

        if ($response->successful()) {
            $post = $response->json()['data'];
            return view('post.show', compact('post'));
        }
    
        return redirect()->route('post.index')->with('error', 'Ürün bilgisi alınamadı.');
    }
    

    


    
    
}
