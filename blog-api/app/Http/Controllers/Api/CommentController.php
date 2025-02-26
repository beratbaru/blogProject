<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Mail\CommentPosted;
use App\Models\User;
class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->where('status','1')->with('user')->get();

        return response()->json($comments);
        
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),  
            'post_id' => $post->id,
            'content' => $request->content,
            'status' => '0',
        ]);
        $admin = User::role('super-admin')->pluck('email')->toArray();//Spatie HasRoles (https://spatie.be/docs/laravel-permission/v6/basic-usage/basic-usage) kullanarak süper admin rolü olan kullanıcıları bir değişkene atıyorum
        \Illuminate\Support\Facades\Mail::to($admin)->queue(
            new CommentPosted($comment)
            );
        
        return response()->json($comment, 201);
    }
}
