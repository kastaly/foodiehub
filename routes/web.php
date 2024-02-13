<?php

use App\Models\View;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    $user = auth()->user();
    $recipes = Recipe::where('user_id', $user->id)->get();
    $categories = Category::all();
    $viewIds = $recipes->pluck('id');
    $views = View::whereIn('recipe_id', $viewIds)->get();
    $usedCategories = Category::whereHas('recipes', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->get();
    
    return view('dashboard', compact('user', 'recipes', 'categories', 'usedCategories', 'views'));
})->middleware(['auth', 'verified'])->name('dashboard');






// Resource routes for recipes
Route::resource('recipes', RecipeController::class);

// Route for showing all recipes

Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'updateProfilePicture'])->name('profile.updateProfilePicture');
});

require __DIR__.'/auth.php';
