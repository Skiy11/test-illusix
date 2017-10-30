<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get recipes list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recipeList()
    {
        $recipes = Recipe::orderBy('id', 'desc')->get();
        return view('recipe', ['recipes' => $recipes]);
    }

    /**
     * Get one recipe
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);
        $ingredients = $recipe->ingredients()->where('recipe_id', $id)->get();

        return view('showRecipe', ['recipe' => $recipe, 'ingredients' => $ingredients]);
    }

    /**
     * Add new recipe
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addRecipe(Request $request)
    {
        $recipe = ['id' => '', 'title' => '', 'description' => ''];
        $ingredients = [];
        if (!$request->isMethod('post')) {
            return view('addRecipe', ['recipe' => $recipe, 'ingredients' => $ingredients]);
        }

        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->save();

        $ingredientTitles = $request->input('ingredient');
        $ingredientQuantities = $request->input('quantity');
        for($i = 0; $i < count($ingredientTitles); $i++) {
            $ingredient = Ingredient::where('title', $ingredientTitles[$i])->first();
            if ($ingredient) {
                $recipe->ingredients()->attach($ingredient->id, ['quantity' => $ingredientQuantities[$i]]);
            } else {
                $ingredient = new Ingredient();
                $ingredient->title = $ingredientTitles[$i];
                $ingredient->save();
                $ingredientId = $ingredient->id;
                $recipe->ingredients()->attach($ingredientId, ['quantity' => $ingredientQuantities[$i]]);
            }
        }

        return redirect('recipe-list');
    }

    /**
     * Update recipe
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function updateRecipe($id, Request $request)
    {
        $recipe = Recipe::where('id', $id)->first();
        $ingredients = $recipe->ingredients()->where('recipe_id', $id)->get();

        if (!$request->isMethod('post')) {
            return view('addRecipe', ['recipe' => $recipe->toArray(), 'ingredients' => $ingredients->toArray()]);
        }

        Recipe::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $updateRecipe = Recipe::find($id);
        $ingredientTitles = $request->input('ingredient');
        $ingredientQuantities = $request->input('quantity');
        foreach ($ingredientTitles as $ingredientId => $ingredientTitle) {
            $ingredient = Ingredient::where('title', $ingredientTitle)->first();
            if ($ingredient) {
                $updateRecipe->ingredients()->updateExistingPivot($ingredientId, ['quantity' => $ingredientQuantities[$ingredientId]]);
            } else {
                $ingredient = new Ingredient();
                $ingredient->title = $ingredientTitle;
                $ingredient->save();
                $updateRecipe->ingredients()->attach($ingredientId, ['quantity' => $ingredientQuantities[$ingredientId]]);
            }
        }

        return redirect('recipe-list');
    }

    /**
     * Remove recipe
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeRecipe($id)
    {
        Recipe::where('id', $id)->delete();
        return redirect('recipe-list');
    }
}
