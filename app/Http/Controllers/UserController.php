<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $posts = $user->posts()->get();
        
        return view('pages.profile')->with('user', $user)->with('posts', $posts);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->user()->is_admin){
           $user->delete();
        }
        else {
            return redirect('/home')->withMessage('You cannot delete this user.');
        }
    }

    public function userposts($id)
    {
        return Post::where('user_id', '=', $id)->paginate(10);
    }

    
}
