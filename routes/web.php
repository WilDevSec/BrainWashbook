<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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

Route::put('/user/{id}', [UserController::class, 'update']);

Route::get('/newsfeed', [NewsFeedController::class, 'index']);

// Route::resources([
//     'posts' => PostController::class,
//     'comments' => CommentController::class,
// ]);

Route::get('/posts/create', [PostController::class, 'create']);

Route::post('/posts', [PostController::class, 'store']);

#Route::resource('posts.comments', CommentController::class)->shallow();

Route::resource('users', AdminController::class)->parameters([
    'users' => 'admin_user'
]);

Auth::routes();


