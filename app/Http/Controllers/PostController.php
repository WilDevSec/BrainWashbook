<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $posts=Post::all();
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => ['required'],
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->get('body');
        if (Auth::check()){
            $post->user_id = $request->user()->id;
        }
        else {
            return withMessage('Must be logged in to create posts');
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $post->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(600,400)->save($location);
            $post->image = $filename;
        }

        $msg = 'Post published successfully';
        $post->save();
        return redirect('/newsfeed')->withMessage($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->latest()->get();
        return view('posts.post')->with('post', $post)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id == $request->user()->id || $request->user()->is_admin){
           return view('posts.edit')->with('post', $post);
        }
        else {
            return redirect('/newsfeed')->withMessage('You do not have permission to edit this post.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->get('body');
        $post->user_id = $request->user()->id;
        $msg = 'Post updated successfully';
        $post->save();
        return redirect('/newsfeed')->withMessage($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id == $request->user()->id || $request->user()->is_admin){
            $post->delete();
            $msg = 'Post Deleted';
        }
        else {
            $msg = 'You do not have permission to delete this post';
        }
        return redirect('/newsfeed')->withMessage($msg);
    }

    public function showAdmin($id){
        $post = Post::findOrFail($id);
        $comments = $post->comments()->latest()->get();
        return view('posts.post')->with('post', $post)->with('comments', $comments);
    }
    
}
