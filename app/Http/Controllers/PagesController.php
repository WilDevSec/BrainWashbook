<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Http\Controllers\PostController;

class PagesController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function getHomepage()
    {
        $posts = [PostController::class, 'postIndex'];
        return view('pages.home'->with($posts));
    }
    
    public function profile($user)
    {
        return view('profile')->with($user);
    }

}
