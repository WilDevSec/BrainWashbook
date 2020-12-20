<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class NewsFeedController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('q')){
    		$q=$request->q;
    		$posts=Post::where('title','like','%'.$q.'%')->orderBy('created_at','desc')->simplePaginate(10);
    	}else{
    		$posts=Post::orderBy('created_at','desc')->simplePaginate(10);
    	}
        return view('pages.newsfeed',['posts'=>$posts]);
    }
}
