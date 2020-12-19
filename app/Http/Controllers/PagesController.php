<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function getHomepage()
    {
        return view('home');
    }
    
    public function profile($user)
    {
        return view('profile')->with($user);
    }

}
