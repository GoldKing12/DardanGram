<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('follow/{user}', [FollowsController::class, 'store']);

Route::get('/p', [PostsController::class, 'index'])->name('posts.index');
Route::get('/p/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts/{post}/like', [PostsController::class, 'like'])->middleware('auth');
Route::post('/p', [PostsController::class, 'store'])->name('posts.store');
Route::delete('/p/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.index');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profiles.edit');
Route::get('/search', [ProfilesController::class, 'search'])->name('profile.search');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/notifications', [ProfilesController::class, 'notifications'])->middleware('auth');
Route::delete('/profile/{user}', [ProfilesController::class, 'destroy'])->name('profile.destroy');

Route::post('/notifications/{notification}/read', [ProfilesController::class, 'markAsRead'])->name('notifications.read');