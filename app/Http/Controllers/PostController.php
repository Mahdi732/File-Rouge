<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index () {
        if (!Auth::check()) {
            return view('media')->with('message', "you have to be login to able to create or see friends post");
        }

        $authUser = Auth::user();

        $posts = $authUser ? DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('friend_requests', function ($join) use ($authUser) {
            $join->on(function ($query) use ($authUser) {
                $query->on('friend_requests.sender_id', '=', 'posts.user_id')
                    ->where('friend_requests.receiver_id', '=', $authUser->id);
            })->orOn(function ($query) use ($authUser) {
                $query->on('friend_requests.receiver_id', '=', 'posts.user_id')
                    ->where('friend_requests.sender_id', '=', $authUser->id);
            });
        })
        ->where(function ($query) use ($authUser) {
            $query->where('posts.user_id', $authUser->id)
                ->orWhere('friend_requests.status', 'accepted');
        })
        ->select('posts.*', 'users.profile_picture', 'users.user_name', 'users.name', 'users.id as user_id')
        ->orderBy('posts.created_at', 'desc')
        ->orderBy('posts.updated_at', 'desc')
        ->take(8)
        ->get() : "you need to loggin";

        return view('media', compact('posts'));
    }

    public function createPost(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('login.auth')->with('success', 'login to get permetion for create new post');
        }

        $request->validate([
            'description' => 'required|string|max:1000',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:51200',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:51200',
        ]);

        $user = Auth::user();

        DB::table('posts')
        ->insert([
            'description' => $request->description,
            'picture' => $request->hasFile('picture') ? $request->file('picture')->store('post/picture', 'public') : null,
            'video' => $request->hasFile('video') ? $request->file('video')->store('post/video', 'public') : null,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('post.media');
    }

    public function delete($id_post) {
        $Authuser = Auth::user();
        DB::table('posts')
        ->where('id', $id_post)
        ->where('user_id', $Authuser->id)
        ->delete();

        return redirect()->route('post.media')->with('success', 'the post has successfuly deleted');
    }

   public function update () {
     
   }

}
