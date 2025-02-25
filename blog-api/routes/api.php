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

Route::get('/test', function(){
    return view('mail.comment-posted');
});

Route::get('/policies', [PolicyController::class, 'getPolicies']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


/*Route::middleware(['auth:sanctum'])->group(function (){

Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::apiResource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index']); // List products
Route::get('/products/{id}', [ProductController::class, 'show']); // Show single product
Route::delete('products/{id}', [ProductController::class, 'destroy']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

});*/

Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('posts', PostController::class);
    Route::get('/posts', [PostController::class, 'index']); // List posts
    Route::get('/posts/{id}', [PostController::class, 'show']); // Show single post
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [ProfileController::class, 'update']);
    
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);

    Route::patch('/comments/{comment}/status', [CommentController::class, 'updateStatus'])
        ->middleware('can:update,comment'); // Ensure proper authorization
    });



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


