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
        ->where('user_id', $Authuser)
        ->select('posts.*')
        ->get();

        return view('media', [
            'posts' => $posts,
        ]);
    }
}
