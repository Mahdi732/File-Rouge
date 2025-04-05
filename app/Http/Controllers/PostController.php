<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index () {
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
            $redirectUrl = route('login.auth') . '?success=' . urlencode('You have to login to send a request.');
            return response()->json([
                'redirect' => $redirectUrl
            ])->withHeaders([
                'HX-Redirect' => $redirectUrl
            ]);
        }

        
    }
}
