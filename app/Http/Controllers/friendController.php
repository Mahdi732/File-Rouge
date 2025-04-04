<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $search = $request->search_for_friend_input;
        $authUser = Auth::user();
        if ($search) {
            $users = User::query()
            ->where('id', '!=', $authUser->id)
            ->where(function ($query) use ($search) {
                $query->where('user_name', 'LIKE', "%{$search}%")
                      ->orWhere('name', 'LIKE', "%{$search}%");
            })
            ->take(8)
            ->get();

            if ($users->isEmpty()) {
                return view('partial.notFoundMessage')->with('message', 'We couldnt find anything matching 😒😒😒');
            }else {
                return view('partial.friendSearchResult', compact('users'));
            }
        }
        
        $users = User::when($authUser, function($query) use ($authUser) {
            $query->where('id', '!=', $authUser->id);
        })
        ->orderBy('name')
        ->take(8)
        ->get();

        return view('partial.friendSearchResult', compact('users'));;
    }

    public function addFriend($friend_id) {
        $user = Auth::user();

            $existingRequest = DB::table('friend_requests')
            ->where(function($query) use ($friend_id, $user) {
                $query->where('receiver_id', $user->id)->where('sender_id', $friend_id);
            })
            ->orWhere(function($query) use ($user, $friend_id) {
                $query->where('receiver_id', $friend_id)->where('sender_id', $user->id);
            })
            ->exists();

        if ($existingRequest) {
            return view('partial.errorHandler')->with('error', 'you have already send request for this user or he ignore you  ');
        }
           
        return view('partial.errorHandler')->with('error', 'you have already send request for this user or he ignore you  ');
    }
}