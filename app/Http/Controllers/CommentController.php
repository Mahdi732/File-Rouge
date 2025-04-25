<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request, $postId) {
        $userAuth = Auth::user();

        $request->validate([
            'comment' => 'required|string',
        ]);

        DB::table('comments')
        ->insert([
            'comment' => $request->comment,
            'postId' => $postId,
            'userId' => $userAuth->id,
            'created_at' => now(),
        ]);
        
        return redirect()->route('post.media');
   }

   public function edit(Request $request, $idComment) {

        $request->validate([
            'comment' => 'required|string',
        ]);

        DB::table('comments')
        ->where('comments.id', $idComment)
        ->update([
            "comment" => $request->comment,
        ]);
        return redirect()->route('post.media');
   }

   public function delete($CommentId) {
    DB::table('comments')
        ->where('comments.id', $CommentId)
        ->delete();
    return redirect()->route('post.media');
   }
}
