<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Fetch all posts
    public function index(Request $request)
    {
        $query = Post::withCount('comments')
                     ->orderByDesc('comments_count')
                     ->latest()
                     ->where('status', 'active');

        // If a category filter is provided, apply it
        if ($request->has('category_id') && !empty($request->input('category_id'))) {
            $query->where('category_id', $request->input('category_id'));
        }

        $posts = $query->paginate(6);

        return response()->json([
            'message' => 'posts fetched successfully',
            'data' => $posts->items(),
            'links' => [
                'previous' => $posts->previousPageUrl(),
                'next' => $posts->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $posts->currentPage(),
                'total_pages' => $posts->lastPage(),
                'total_posts' => $posts->total(),
            ],
        ], 200);
    }
    

    // public function popular(){
    //     $post = Post::withCount('comments')
    //     ->orderBy('comments_count', 'desc')
    //     ->get();
    //     return response()->json($post);
    // }
    
    

    // Store a new post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'post_price' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $post = post::create($request->only(['post_name', 'description', 'post_price']));

        return response()->json([
            'message' => 'post created successfully',
            'data' => $post,
        ], 201);
    }

    // Show a single post
    public function show($id)
    {
        $post = post::find($id);
    
        if (!$post) {
            return response()->json(['message' => 'post not found'], 404);
        }
    
        return response()->json([
            'message' => 'post fetched successfully',
            'data' => $post,
        ]);
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        // Find the post by its ID
        $post = post::find($id);
    
        if (!$post) {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    
        // Validate the incoming data
        $validated = $request->validate([
            'post_name' => 'required|string|max:255',
            'post_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        // Update the post with the new data
        $post->update($validated);
    
        // Return success response
        return response()->json([
            'message' => 'Ürün başarıyla güncellendi.',
            'data' => $post,
        ], 200);
    }
    

    // Delete a post
// kleapi/app/Http/Controllers/Api/PostController.php

public function destroy($id)
{
    $post = post::find($id);
    
    if (!$post) {
        return response()->json(['message' => 'Ürün bulunamadı.'], 404);
    }

    $post->delete();

    return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
}


}
