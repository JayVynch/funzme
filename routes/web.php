<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatController;

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
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ HomeController::class, 'index'])->name('dashboard');

// Post Routes

Route::post('/posts/store', [PostController::class, 'store'])->name('tweet');

Route::get('/posts' , [PostController::class, 'index'])->name('post.index');

// like routes for posts and comments

Route::post('/posts/{id}/like' , [PostController::class, 'addLike'])->name('post.addlike');

Route::delete('/posts/{id}/like', [PostController::class, 'unLike']);

Route::post('/comments/{id}/like' , [CommentController::class, 'addLike'])->name('comment.addlike');

Route::delete('/comments/{id}/like', [CommentController::class, 'unLike']);

// comments routes

Route::post('/posts/{id}/comment',[CommentController::class, 'store' ])->name('post.comment');

Route::get('/posts/{id}/comments',[CommentController::class, 'index' ])->name('post.comments');

// Follow and unfollow route

Route::post('/users/{email}/follow',[FollowController::class,'getFollowed'])->name('users.follow');

Route::delete('/users/{email}/unfollow',[FollowController::class,'unFollow'])->name('users.unfollow');

// search

Route::get('/users/search',[SearchController::class,'searchUser'])->name('users.search');

// user Profile

Route::get('/users/{username}/page',[HomeController::class,'userPage'])->name('users.page');

// Notification Routes

Route::get('/users/{username}/notifications',[HomeController::class,'notifications'])->name('users.notifications');

Route::post('/notifications/{id}',[HomeController::class,'markNotificationAsRead']);

Route::delete('/notifications/{id}',[HomeController::class,'destroyNotification']);

Route::post('/notification/{id}',[HomeController::class,'updateNotification']);

// Chat system routes

Route::get('/users/direct/message',[ChatController::class,'index'])->name('users.chat');

Route::get('/users/{contact_id}/direct/messages',[ChatController::class,'userDirectMessages']);

Route::post('/users/{contact_id}/direct/message',[ChatController::class,'store']);

Route::get('/users/{id}/contacts',[ChatController::class,'getContacts']);