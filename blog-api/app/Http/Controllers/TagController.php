<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return ApiResponse::success($tags, 201);
    }
}
