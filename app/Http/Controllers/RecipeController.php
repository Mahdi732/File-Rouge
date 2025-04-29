<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'steps' => 'required|array', 
            'ingredients' => 'required|array',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm', 
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif',
            'difficulty' => 'required|in:easy,medium,hard',
            'notes' => 'nullable|string',
            'prep_time' => 'required|integer',
            'categories' => 'required|array',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login.auth');
        }

        $recipe = Recipe::create([
            'userId' => Auth::user()->id,
            'title' => $request->title,
            'etap' => json_encode($request->steps),
            'description' => $request->description,
            'note' => $request->notes,
            'video' => $request->hasFile('video') ? $request->file('video')->store('recipes/video', 'public') : null,
            'image' => $request->hasFile('image') ? $request->file('image')->store('recipes/image', 'public') : null,
            'ingredients' => json_encode($request->ingredients),
            'timepreparation' => $request->prep_time,
            'levelPreparation' => $request->difficulty,
            'created_at' => now(),
        ]);

        $catigoriesIds = Category::whereIn('name', $request->categories)->pluck('id')->toArray();
        $recipe->categories()->attach($catigoriesIds);

        return redirect()->route('library.recipe');
    }

    public function searchCategorie(Request $request) {
        $search = $request->categoriesSearch;
        if ($search) {
            $categories = DB::table('categories')
            ->where("name", "LIKE", "%{$search}%")
            ->take(8)
            ->get();
            if ($categories->isEmpty()) {
                return 'We couldnt find anything matching 😒😒😒';
            }
            if ($categories) {
                return view('partial.categories_list', compact('categories'));
            }
        }
        $categories = DB::table('categories')
            ->take(8)
            ->get();
        
        return view('partial.categories_list', compact('categories'));
    }

    public function index()
    {
        $recipes = Recipe::with(['user', 'categories'])
        ->latest() 
        ->take(3) 
        ->get();
    
        $First_recipe = Recipe::with(['user', 'categories'])
        ->first();

        $categories = Category::select('id', 'name')->get();

        return view('Biblio', compact('recipes', 'First_recipe', 'categories'));
    }
}
