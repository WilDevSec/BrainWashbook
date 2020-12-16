<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PagesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getLogin()
    {
        return view('login');
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
