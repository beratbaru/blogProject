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

Route::resource('post', PostController::class);

Route::get('/posts/{postId}', [CommentController::class, 'show'])->name('post.show');
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/policies/{type}', [PolicyController::class, 'getPolicies'])->name('policy');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/', [PostController::class, 'index']);

Route::get('login', [UserController::class, 'showLoginForm'])->name('login'); 
Route::post('login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::post('/logout', function () {
    session()->forget('api_token');
    return redirect('/login')->with('success', 'Başarıyla çıkış yaptınız.');
})->name('logout');

Route::get('profile', [UserController::class, 'show']);
Route::put('profile', [UserController::class, 'update'])->name('profile.update');