<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Athenthicate

Route::get('/login', function () {
    return view('login');
});
Route::post('/login/checking', [UserController::class, 'login'])->name('login');
Route::post('/register/chacking', [UserController::class, 'register'])->name('register');
Route::post('/logOut', [UserController::class, 'logOut'])->name('logOut');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//profile management

Route::middleware(['auth.user'])->group(function () {
    Route::get('/profile', [UserController::class, 'getUserInfo']);
    Route::put('/update/profile', [UserController::class, 'updateProfile'])->name('editProfile');
    Route::delete('/delete/profile', [UserController::class, 'deleteAccount'])->name('deleteAccount');
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/friend', function () {
    return view('friends');
});







Route::get('/biblio', function () {
    return view('biblio');
});

Route::get('/recipe', function () {
    return view('recipe');
});

Route::get('/media', function () {
    return view('media');
});


Route::middleware(['auth.admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    });
});



Route::get('/login/admin', function () {
    return view('adminLogin');
});