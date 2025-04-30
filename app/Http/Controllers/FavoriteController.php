<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addFavorite($id) {
        if (!Auth::check()) {
            return redirect()->route('login.auth');
        }

        Favorite::create([
            'userId' => Auth::user()->id,
            'recipeId' => $id,
            'created_at' => now(),
        ]);

        return redirect()->route('library.recipe');
    }

    public function removeFavorite($id) {
        if (!Auth::check()) {
            return redirect()->route('login.auth');
        }
        
        $recipe = Favorite::findOrFail($id);
        $recipe->delete();

        return redirect()->route('library.recipe');
    }
}
