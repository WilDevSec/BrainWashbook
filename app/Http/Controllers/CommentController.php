<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentOnPost;

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
        $comments = $post->comments();
        // return response()->toJson($comments->with('user')->latest()->get());
        return $comments->with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => ['required'],
        ]);
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->body = $request->get('body');
        $comment->post_id = $post->id;
        if (Auth::check()){
            $comment->user_id = $request->user()->id;
        }
        else {
            return withMessage('Must be logged in to post comments');
        }

        $comment->save();
        $post->user->notify(new CommentOnPost($post));
        return redirect('/posts/'.$id)->withMessage('Comment successfully added');
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
            $msg = 'Comment Deleted';
        }
        else {
            $msg = 'You do not have permission to delete this comment.';
        }
        return redirect('/newsfeed')->with($msg);
    }
}
