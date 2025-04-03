<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class friendController extends Controller
{
    public function index() {
        $user = Auth::user();

        $users = User::Where('id', '!==', $user->id)
        ->orderBy('name')
        ->limit(6);

        return view('partial.friends', compact('users'));
    }
}
