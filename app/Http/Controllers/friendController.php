<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class friendController extends Controller
{
    public function index() {
        $authUser = Auth::user();

        if (!$authUser) {
            $users = User::where()
                    ->orderBy('name')
                    ->take(6)
                    ->get();
        
        return view('friends', ['users' => $users]);
        }
        
        $users = User::where('id', '!=', $authUser->id)
                    ->orderBy('name')
                    ->take(6)
                    ->get();
        
        return view('friends', ['users' => $users]);
    }
}
