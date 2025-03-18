<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {

        $request->validate([
            'user_name' => 'required|string|max:20|min:5',
            'name' => 'required|string|max:50|min:7',
            'email' => 'required|string|max:250',
            'password' => 'required|string|min:8'
        ]);



        $user = User::create([
            'user_name' => $request->user_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|max:250',
            'password' => 'required|string|max:250|min:8'
        ]);

        $user = User::Where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect('/login')->with('error', 'zabba');
    }
}
