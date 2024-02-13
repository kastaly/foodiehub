<?php

namespace App\Http\Controllers;

use App\Models\View;
use App\Models\Recipe;
use Illuminate\Http\Request;

class viewsController extends Controller
{
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        
        // Retrieve the view count for the recipe
        $views = View::where('recipe_id', $recipe->id)->value('views');
    
        return view('recipe.show', compact('recipe', 'views'));
    }
}
