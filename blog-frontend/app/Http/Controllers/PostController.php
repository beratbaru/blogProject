<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = $request->only(['category_id', 'tag', 'page']);

        $postResponse = Http::withHeaders([
            'Authorization' => session('api_token')
        ])->get(env('API_URL') . '/api/posts', $queryParams);
        
        $meta = $postResponse->json()['data']['data'];

        $posts = $postResponse->json('data', []) ?? [];
        $paginationLinks = $meta['links'] ?? [];
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['last_page'] ?? 1;
        $totalPosts = $meta['total'] ?? 0;


        return view('post.index', compact('posts', 'paginationLinks', 'currentPage', 'totalPages', 'totalPosts'));
    }
}
