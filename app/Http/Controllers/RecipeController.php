<?php

namespace App\Http\Controllers;

use App\Models\View;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        $categories = Category::all();
        $views=View::All();
        // Fetch all categories
        return view('recipe.recipes', compact('recipes', 'categories')); // Use 'recipes' instead of 'recipe'
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $categories = Category::all();
        return view("recipe.create", compact("categories"));

    }
    public function showsingle(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $recipe = new Recipe([
                'user_id' => $userId, // Set user_id to the ID of the authenticated user
                'title' => $request->title,
                'category_id' => $request->category_id,
                'steps' => $request->steps,
                'ingredients' => $request->ingredients,
                'total_time' => $request->total_time,
                'servings' => $request->servings,
                'image' => $request->image,
                'video' => $request->video,
            ]);
            
            if ($request->hasFile('image')) {
                $recipe->image = $request->file('image')->store('recipe','public');
            }
            if ($request->hasFile('video')) {
                $recipe->video = $request->file('video')->store('recipe','public');
            }
        
            $recipe->save();
            return redirect()->route('recipes.index')->with('success', 'Recipe added successfully.');
        } else {
            // Handle case where user is not authenticated
            return redirect()->back()->with('error', 'User not authenticated.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);//find a record by its primary key, and if no record is found, it throws a ModelNotFoundException
       //tries to find the record matching the
       // specified conditions, and if it doesn't exist, it creates a new one
        $view = View::firstOrCreate(['recipe_id' => $recipe->id]);
    $view->increment('views');
    $views = $view->views;
        return view('recipe.show', compact('recipe','views'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
/**
 * Show the form for editing the specified resource.
 */
public function edit(Recipe $recipe)
{
    // Check if the authenticated user owns the recipe
    if (Auth::user()->id === $recipe->user_id) {
        $categories = Category::all(); // Fetch all categories
        return view('recipe.edit', compact('recipe', 'categories'));
    } else {
        // Redirect the user with an error message if they don't have permission
        return redirect()->route('recipes.index')->with('error', 'You do not have permission to edit this recipe.');
    }
}


/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Recipe $recipe)
{
    // Check if the authenticated user owns the recipe
    if (Auth::user()->id === $recipe->user_id) {
        $recipe->update($request->all());
        
        // Handle image and video uploads if new files are provided
        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipe', 'public');
        }
        if ($request->hasFile('video')) {
            $recipe->video = $request->file('video')->store('recipe', 'public');
        }
        
        $recipe->save();
        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipe updated successfully.');
    } else {
        // Redirect the user with an error message if they don't have permission
        return redirect()->route('recipes.index')->with('error', 'You do not have permission to update this recipe.');
    }
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Recipe $recipe)
{
    // Check if the authenticated user owns the recipe
    if (Auth::user()->id === $recipe->user_id) {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    } else {
        // Redirect the user with an error message if they don't have permission
        return redirect()->route('recipes.index')->with('error', 'You do not have permission to delete this recipe.');
    }
}

}
