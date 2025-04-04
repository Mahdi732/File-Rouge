<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class friendController extends Controller
{
    public function index() {
        $authUser = Auth::user();
    
        $users = User::when($authUser, function($query) use ($authUser) {
                $query->where('id', '!=', $authUser->id);
            })
            ->orderBy('name')
            ->take(8)
            ->get();
        
        return view('friends', compact('users'));
    }

    public function searchFriend(Request $request) {
        if ($request->search_for_friend_input === "a") {
            return "test 1";
        }
        return "88";
    }
}