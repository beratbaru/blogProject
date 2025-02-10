<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\PolicyController;
// Resource Route for posts (handles all CRUD routes)
Route::resource('post', PostController::class);

Route::get('/posts/{postId}', [CommentController::class, 'show'])->name('post.show');
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/policy/kvkk', [PolicyController::class, 'showKvkkPolicy'])->name('policy.kvkk');
Route::get('/policy/policy', [PolicyController::class, 'showSecurityPolicy'])->name('policy.policy');

// Alias for post Index
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Home Route
Route::get('/', function () {
    
    return view('main');
});

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login'); 
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(CheckLogin::class);

// Register Routes
Route::get('/register', function () {
    return view('register');
})->name('register'); // Registration form

Route::post('/register', [UserController::class, 'register'])->name('register.submit'); // Registration submission

Route::get('/test', function () {
    return view('test');
})->name('test'); // Registration form

// Main Page (requires authentication)
Route::get('/main', function () {
    return view('main');
})->name('main')->middleware(CheckLogin::class);

// Logout Route
Route::post('/logout', function () {
    session()->forget('api_token');
    return redirect('/login')->with('success', 'Başarıyla çıkış yaptınız.');
})->name('logout');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('posts/{id}', [PostController::class, 'update'])->name('post.update');
//x

Route::get('profile', [UserController::class, 'show']);
Route::put('profile', [UserController::class, 'update'])->name('profile.update');