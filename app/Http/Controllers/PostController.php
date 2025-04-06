<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index () {
        if (Auth::check()) {
            return view('media')->with('message', "you have to be login to able to create or see friends post");
        }

        $Authuser = Auth::user();
        $posts = DB::table('posts')
        ->where('user_id', $Authuser->id)
        ->select('posts.*')
        ->get();

        return view('media', [
            'posts' => $posts,
        ]);
    }

    public function createPost(Request $request) {
        if (!Auth::check()) {
            $redirectUrl = route('login.auth') . '?success=' . urlencode('You have to login to create Post. 🤷‍♂️🤷‍♂️🤷‍♂️');
            return response()->json([
                'redirect' => $redirectUrl
            ])->withHeaders([
                'HX-Redirect' => $redirectUrl
            ]);
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
            'picture' => $request->hasFile('picture') ? $request->file('picture')->store('posts/video', 'public') : null,
            'video' => $request->hasFile('video') ? $request->file('video')->store('posts/picture', 'public') : null,
            'user_id' => $user->id,
        ]);

        return redirect()->route('post.create.media');
    }
}
