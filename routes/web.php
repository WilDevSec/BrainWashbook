<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

#Route::get('/', 'App\Http\Controllers\PagesController@getHomepage');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('index');

Route::get('/', function () {
    return view('pages.home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

// Route::get('/profile/{$id}', function(){
//     if(Auth::check()){
//         return view('pages.profile');
//     }
// })

#Route::get('/feed')

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


