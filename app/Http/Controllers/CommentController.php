<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->get();
        return $comments->latest();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id;
        ]);
        #$comment = Comment::where('id', $comment->id)->with('user')->first();
        $comment->save();
        return response()->toJson($comment);

        // $request->validate([ 'body' => 'required', ]);
        // $post = Post::where('id')->findOrFail($id);
        // $comment = new Comment();
        // $comment->body = $request->input('body');
        // $comment->user_id = $request->user()->id;
        // $comment->post_id = $post->post()->id;
        // $comment->save($request->all());

        // $count = count(Comment::where('post_id',$id)->get());
        // $comment->count = $count; 

        // return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == $request->user()->id || $request->admin()){
            $comment->delete();
            $message = 'Comment Deleted'
        }
        else {
            $message = 'You do not have permission to delete this comment.'
        }
        return redirect('/newsfeed')->with($message);
    }
}
