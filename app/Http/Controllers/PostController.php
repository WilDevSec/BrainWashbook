<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->get('body');
        $post->user_id = $request->user()->id;
        $msg = 'Post published successfully';
        $post->save();
        return redirect('/newsfeed')->withMessage ($msg);
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
        if ($post->user_id == $request->user()->id || $request->user()->){
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
        if ($post->user_id == $request->user()->id || $request->routeIs('admin.*')){
            $post->delete();
            $msg = 'Post Deleted';
        }
        else {
            $msg = 'Can only delete your own posts';
        }
        return redirect('/newsfeed')->withMessage($msg);
    }

    // Save Comment
    public function saveCommentTwo(Request $request){
        $data= new Comment();
        $data->post_id=$request->post;
        $data->comment_text=$request->comment;
        $data->save();
        return response()->json([
            'bool'=>true
        ]);
    }

    public function showAdmin($id){
        $post = Post::findOrFail($id);
        $comments = $post->comments()->latest()->get();
        return view('posts.post')->with('post', $post)->with('comments', $comments);
    }
    
}
