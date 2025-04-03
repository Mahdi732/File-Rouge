<?php

use App\Http\Controllers\friendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::prefix('auth')->group(function () {
    // Login Routes
    Route::get('/login', function () {
        if(Auth::check()) {
            return redirect()->route('profile');
        }
        return view('login');
    })->name('login.auth');
    
    Route::get('/login/admin', function () {
        if(Auth::check()) {
            return redirect()->route('profile');
        }
        return view('adminLogin');
    });
    
    Route::post('/login/checking', [UserController::class, 'login'])->name('login');
    
    // Registration Route
    Route::post('/register/checking', [UserController::class, 'register'])->name('register');
    
    // Logout Route
    Route::post('/logout', [UserController::class, 'logOut'])->name('logout');
});

// Profile Management (Authenticated User Routes)
Route::middleware(['auth.user'])->prefix('profile')->group(function () {
    Route::get('/', [UserController::class, 'getUserInfo'])->name('profile');
    Route::put('/update/picture', [UserController::class, 'updateProfilePicture'])->name('profile.update.picture');
    Route::put('/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/update/password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('profile.delete');

});

// Admin Routes
Route::middleware(['auth.admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin');
    })->name('admin.dashboard');
});

Route::prefix('friend')->group(function () {
    Route::get('/', [FriendController::class, 'index'])->name('app.friends');
});

// Application Routes
Route::prefix('app')->group(function () {
    
    Route::get('/library', function () {
        return view('biblio');
    })->name('app.library');
    
    Route::get('/recipes', function () {
        return view('recipe');
    })->name('app.recipes');
    
    Route::get('/media', function () {
        return view('media');
    })->name('app.media');
}); 