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

        return redirect("/");
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|max:250',
            'password' => 'required|string|max:250|min:8'
        ]);

        $user = User::Where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return redirect('/login')->with('password_error', 'Invalid password try another time');
            }
            Auth::login($user);
            $request->session()->regenerate();
            return redirect("/");
        }
        
        return redirect('/login')->with('email_error', 'Invalid email try another time');
    }

    public function logOut(){
        Auth::logout();
        return redirect('/login');
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Unothorized');
        }

        $request->validate([
            'first_name' => 'required|string|max:20|min:5',
            'user_name' => 'required|string|max:50|min:5',
            'email' => 'required|string|max:250',
            'bio' => 'required|string',
        ]);

        $user->update([
            'name' => $request->first_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        return view("partial.errorHandler");
    }
    
    public function deleteAccount(Request $request) {
        $user = Auth::user();
        $request->validate([
            'email' => 'required|string|max:250',
            'password' => 'required|string|max:250|min:8'
        ]);

        $user = User::Where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return 'Invalid password try another time';
            }
            $user->forceDelete();
            return redirect('/login');
        }

        return 'Invalid email try another time';
    }

    public function getUserInfo(){
        $user = Auth::user();
        return view("user", ['user' => $user]);
    }

}
