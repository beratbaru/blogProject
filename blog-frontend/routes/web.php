<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\PolicyController;

Route::get('/', function () {
    return view('post.index');
});

// Resource Route for posts (handles all CRUD routes)
Route::resource('post', PostController::class);

Route::get('/posts/{postId}', [CommentController::class, 'show'])->name('post.show');
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/policy/kvkk', [PolicyController::class, 'showKvkkPolicy'])->name('policy.kvkk');
Route::get('/policy/policy', [PolicyController::class, 'showSecurityPolicy'])->name('policy.policy');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.submit');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(CheckLogin::class);

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/main', function () {
    return view('main');
})->name('main')->middleware(CheckLogin::class);

Route::post('/logout', function () {
    session()->forget('api_token');
    return redirect('/login')->with('success', 'Başarıyla çıkış yaptınız.');
})->name('logout');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('posts/{id}', [PostController::class, 'update'])->name('post.update');

Route::get('profile', [UserController::class, 'show']);
Route::put('profile', [UserController::class, 'update'])->name('profile.update');