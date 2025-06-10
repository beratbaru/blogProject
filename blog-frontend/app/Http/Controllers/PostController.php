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

        $postResponse = ApiRequest::request('get', '/api/posts', $queryParams);
        
        

        $posts = $postResponse->json('data', []) ?? [];
        $paginationLinks = $postResponse->json()['data']['data']['links'] ?? [];
        $currentPage = $postResponse->json()['data']['data']['current_page'] ?? 1;
        $totalPages = $postResponse->json()['data']['data']['last_page'] ?? 1;
        $totalPosts = $postResponse->json()['data']['data']['total'] ?? 0;


        return view('post.index', compact('posts', 'paginationLinks', 'currentPage', 'totalPages', 'totalPosts'));
    }
}
