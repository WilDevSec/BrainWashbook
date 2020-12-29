<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
#use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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

Route::get('/', [HomeController::class, 'homepage'])->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'homepage']);

Route::get('/user/{id}', [UserController::class, 'show']);

#Route::put('/user/{id}', [UserController::class, 'update']);

Route::get('/admin/{id}/delete', [UserController::class, 'destroy']);

Route::get('/newsfeed', [NewsFeedController::class, 'index']);

Route::resource('comments', CommentController::class);

Route::get('/posts/create', [PostController::class, 'create']);

Route::get('/posts/{id}/edit', [PostController::class, 'edit']);

Route::post('/posts', [PostController::class, 'store']);

Route::post('/posts/{id}/update', [PostController::class, 'update']);

Route::get('/posts/{id}', [PostController::class, 'show']);

Route::get('/posts/{id}/delete', [PostController::class, 'destroy']);

Route::resource('admins', AdminController::class);

Auth::routes();


