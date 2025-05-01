<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function create(Request $request, $id) {
        $request->validate([
            'rating' => 'required|integer|min:1',
            'comment' => 'required|string|max:250',
        ]);

        Reviews::create([
            'rate' => $request->rating,
            'content' => $request->comment,
            'userId' => Auth::user()->id,
            'recipeId' => $id
        ]);

        return redirect()->route('get.recipe', $id);

    }

    public function edit(Request $request, $id) {

    }

    public function remove($id) {
        $review = Reviews::findOrFail($id);
        $review->delete();

        return redirect()->route('library.recipe');
    }
}
