<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/posts/{id}/store', [CommentController::class, 'store'])->name('api.posts.{id}.store');


Route::get('/posts/{id}/index', [CommentController::class, 'index'])->name('api.posts.{id}.index');

