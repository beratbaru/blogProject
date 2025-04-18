<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return ApiResponse::success($categories, 201);
    }
}
