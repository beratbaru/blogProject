<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{

    
    public function store(Request $request, $postId)
    {
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->post(env('API_URL') . "/api/posts/{$postId}/comments", $request->all());
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Yorumunuz incelemeye gönderildi!');
        }
    
        return back()
            ->withErrors($response->json()['errors'] ?? ['API error'])
            ->withInput();
    }
    // CommentController.php
    public function show($postId)
    {
        // Fetch the post data
        $responsePost = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . "/api/posts/{$postId}");
    
        // Fetch comments for the post
        $responseComments = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . "/api/posts/{$postId}/comments");
    
        // Debugging: Check the API responses
    
        // Check if both the post and comments request were successful

    
        $post = $responsePost->json()['data'] ?? null;
        $comments = $responseComments->successful() ? $responseComments->json() : [];
        
        // Pass both post and comments to the view
        return view('post.show', compact('post', 'comments', 'postId'));
    }
    
    
}
