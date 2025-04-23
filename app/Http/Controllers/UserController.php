<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(Request $request) {
        if(Auth::check()) {
            return redirect()->route('profile');
        }

        $request->validate([
            'user_name' => 'required|string|max:20|min:3|unique:users,user_name',
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
        if(Auth::check()) {
            return redirect()->route('profile');
        }
        
        $request->validate([
            'email' => 'required|string|max:250',
            'password' => 'required|string|max:250|min:8'
        ]);

        $user = User::Where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return redirect('auth/login')->with('password_error', 'Invalid password try another time');
            }
            Auth::login($user);
            $request->session()->regenerate();
            return redirect("/");
        }
        
        return redirect('/auth/login')->with('email_error', 'Invalid email try another time');
    }

    public function logOut(Request $request) {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect('/auth/login');
    }
    

    public function updateProfile(Request $request){
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login.auth')->with('error', 'Unothorized');
        }

        $request->validate([
            'first_name' => 'required|string|max:20|min:5',
            'user_name' => 'required|string|max:50|min:3',
            'email' => 'required|string|max:250',
            'bio' => 'required|string',
        ]);

        $user->update([
            'name' => $request->first_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        return view("partial.updated")->with('update', 'your Profile has been successfuly updated!👌👌');
    }

    public function updateProfilePicture(Request $request) {
        if (!Auth::check()){
            return redirect()->route('login.auth')->with('error', 'Unothorized for this moment');
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->profile_picture && Storage::exists($user->profile_picture)) {
                Storage::delete($user->profile_picture);
            }
        }

        $path = $request->file('image')->store('images', 'public');
        $user->update([
            'profile_picture' => $path,
        ]);

        return view("partial.updated")->with('update',  'Your profile Picture has been successfully updated!');
    }
    
    public function deleteAccount(Request $request) {
        $user = Auth::user();
        $request->validate([
            'email' => 'required|string|max:250',
            'password' => 'required|string|max:250|min:8'
        ]);
        if ($user->email == $request->email) {
            $user = User::Where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return view('partial.errorHandler')->with('error', 'the password you enter is not correct pkease try another time.');
            }
            $user->forceDelete();
            if ($request->header('HX-Request')) {
                $redirectUrl = route('login.auth') . '?success=' . urlencode('Your account has been successfully deleted.');
                return response()->json([
                    'redirect' => $redirectUrl
                ])->withHeaders([
                    'HX-Redirect' => $redirectUrl
                ]);
            }
        }
        return view('partial.errorHandler')->with('error', 'Invalid email try another time.');

        }
        
        return view('partial.errorHandler')->with('error', "that's not the right email, try again.");
    }

    public function updatePassword(Request $request) {

        $request->validate([
            "old_password" => "required|string|min:8",
            "new_password" => "required|string|min:8",
            "new_password_confirm" => "required|string|min:8",
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return view("partial.errorHandler")->with('error', 'This password is not the correct password ');
        }

        if ($request->new_password !== $request->new_password_confirm) {
            return view("partial.errorHandler")->with('error', 'the new password that you enter is not the same.');
        }

        $user->update([
            'password' => Hash::make($request->new_password_confirm),
        ]);
        
        return view('partial.updated')->with('update', 'your password has been successfully updated! 🤞🤞🤞');
    }

    public function updateBackground(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login.auth')->with('error', 'Unothorized for this moment');
        }

        $request->validate([
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ]);

        $user = Auth::user();

        if ($request->hasFile('background_image')) {
            if ($user->background_image && Storage::exists($user->background_image)) {
                Storage::delete($user->background_image);
            }
            
        }

        $path = $request->file('background_image')->store('background', 'public');
        $user->update([
            'background_image' => $path
        ]);

        return view("partial.updated")->with('update',  'Your profile Picture has been successfully updated!');
    }

    public function getUserInfo(){
        $user = Auth::user();
        return view("user", ['user' => $user]);
    }

}
