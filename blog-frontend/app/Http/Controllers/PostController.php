<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\post;
use Illuminate\Pagination\LengthAwarePaginator;
class PostController extends Controller
{
    // Fetch all posts
    public function index(Request $request)
    {
        // Fetch posts from the API. request()->query() will include category_id if set.
        $postResponse = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/posts', $request->query());

        $posts = $postResponse->json()['data'] ?? [];
        $paginationLinks = $postResponse->json()['links'] ?? [];
        $meta = $postResponse->json()['meta'] ?? [];
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['total_pages'] ?? 1;
        $totalposts = $meta['total_posts'] ?? 0;

        // Fetch categories from the API
        $categoryResponse = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/categories');
        $categories = $categoryResponse->json()['data'] ?? [];

        return view('post.index', compact('posts', 'paginationLinks', 'currentPage', 'totalPages', 'totalposts', 'categories'));
    }
    
    
    
    
    
    
    

    // Show the form to create a new post
    public function create()
    {
        return view('post.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->post(env('API_URL') . '/api/posts', $request->all());

        if ($response->successful()) {
            return redirect()->route('post.index')->with('success', 'post created successfully.');
        }

        return back()->withErrors($response->json()['errors'] ?? ['API error'])->withInput();
    }

    // Read (view) a single post's details (renders show.blade.php)
    public function show($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->get(env('API_URL') . '/api/posts/'. $id, $request->all());

        if ($response->successful()) {
            $post = $response->json()['data']; // Extract the "data" key
            return view('post.show', compact('post')); // Pass the post data to the view
        }
    
        return redirect()->route('post.index')->with('error', 'Ürün bilgisi alınamadı.'); // Handle API errors
    }
    
    

    // Update a post
    public function update(Request $request, $id)
    {
        
        // Validate the input fields
        $validated = $request->validate([
            'post_name' => 'required|string|max:255',
            'post_price' => 'required|numeric|min:0.1|max:99999999.99', // Allows up to 10 digits, 2 decimals
            'description' => 'required|string',
        ]);
    
        // Send a PUT request to update the post
        $response = Http::acceptJson()
            ->withHeaders([
                'Authorization' => session('api_token'), // Include the token for authorization
            ])
            ->put(env('API_URL') . '/api/posts/' . $id, $validated); // Send validated data
    
        // Check if the response was successful
        if ($response->successful()) {
            return redirect()->route('post.index')->with('success', 'Ürün başarıyla güncellendi.');
        }
    
        // If the request failed, redirect with an error message
        return redirect()->route('post.index')->with('error', 'Ürün güncellenirken bir hata oluştu.');
    }
    
    public function edit($id, Request $request)
{
    // Send a GET request to fetch the post by ID
    $response = Http::acceptJson()
        ->withHeaders([
            'Authorization' => session('api_token'), // Include the token for authorization
        ])
        ->get(env('API_URL') . '/api/posts/' . $id);

    // Check if the response is successful
    if ($response->successful()) {
        // Get the post data
        $post = $response->json()['data']; // The data comes under 'data' in the response
        return view('post.edit', compact('post')); // Return the edit view with the post data
    }

    // If the post fetch fails, redirect with an error message
    return redirect()->route('post.index')->with('error', 'Ürün bilgisi alınamadı.');
}


    // Delete a post
    public function destroy($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->delete(env('API_URL') . '/api/posts/'. $id, $request->all());

    
        if ($response->successful()) {
            return redirect()->route('post.index')->with('success', 'Ürün başarıyla silindi.');
        }
    
        return redirect()->route('post.index')->with('error', 'Ürün silinirken bir hata oluştu.');
    }
    
    
}
