<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getLogin()
    {
        return view('pages.login');
    }

    public function getHomepage()
    {
        return view('homepage');
    }
    
    public function profile($user)
    {
        return view('profile')->with($user);
    }

}
