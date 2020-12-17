<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\PagesController@getLogin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/user/{id}', [UserController::class, 'show']);

Route::put('/user/{id}', [UserController::class, 'update']);

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
]);

#Route::resource('posts.comments', CommentController::class)->shallow();

Route::resource('users', AdminUserController::class)->parameters([
    'users' => 'admin_user'
]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
