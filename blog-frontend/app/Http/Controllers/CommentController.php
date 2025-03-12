<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{

    
    public function store(Request $request, $postId)
    {
        $response = ApiRequest::request('post', "/api/posts/{$postId}/comments", $request->all());
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Yorumunuz incelemeye gönderildi!');
        }
    
        return back()->withErrors($response->json('errors', ['Bilinmeyen bir hata oluştu.']))->withInput();
    }
    public function show(Request $request, $postId)
    {
        $responsePost = ApiRequest::request('get', "/api/posts/{$postId}");
    
        $responseComments = ApiRequest::request('get', "/api/posts/{$postId}/comments", $request->all());

    
        $post = $responsePost->json()['data'] ?? null;
        $comments = $responseComments->successful() ? $responseComments->json() : [];
        
        return view('post.show', compact('post', 'comments', 'postId'));
    }
    
    
}
