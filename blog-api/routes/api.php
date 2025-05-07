<?php
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\TagController;
use \App\Http\Controllers\Api\CategoryController;

Route::get('/policies/{type}', [PolicyController::class, 'getPolicies']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/posts/{id}', [PostController::class, 'show']); 
    Route::get('/posts', [PostController::class, 'index']);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [ProfileController::class, 'update']);
    
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


