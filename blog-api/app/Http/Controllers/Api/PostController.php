<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
public function index(Request $request)
{
    $query = Post::withCount('comments')
                 ->with('tags')  
                 ->orderByDesc('comments_count')
                 ->latest()
                 ->where('status', 'active');

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('tag')) {
        $query->whereHas('tags', function ($q) use ($request) {
            $q->where('name', $request->tag);
        });
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






}
