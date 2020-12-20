<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsFeedController;

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
    return view('pages.home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Route::get('/home', 'HomeController@index');

Route::get('/user/{id}', [UserController::class, 'show']);

Route::put('/user/{id}', [UserController::class, 'update']);

Route::get('/newsfeed', [NewsFeedController::class, 'index']);

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
]);

#Route::resource('posts.comments', CommentController::class)->shallow();

Route::resource('users', AdminUserController::class)->parameters([
    'users' => 'admin_user'
]);

Auth::routes();


