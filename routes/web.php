<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ HomeController::class, 'index'])->name('dashboard');

Route::post('/posts/store', [PostController::class, 'store'])->name('tweet');

Route::get('/posts' , [PostController::class, 'index'])->name('post.index');

Route::post('/posts/{id}/like' , [PostController::class, 'addLike'])->name('post.addlike');

Route::delete('/posts/{id}/like', [PostController::class, 'unLike']);

Route::post('/comments/{id}/like' , [CommentController::class, 'addLike'])->name('post.addlike');

Route::delete('/comments/{id}/like', [CommentController::class, 'unLike']);

Route::post('/posts/{id}/comment',[CommentController::class, 'store' ])->name('post.comment');

Route::get('/posts/{id}/comments',[CommentController::class, 'index' ])->name('post.comments');