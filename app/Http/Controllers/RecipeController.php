<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        $recipe = Recipe::where('id', $id)->first()->toArray();
        return view('showRecipe', ['recipe' => $recipe]);
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
        if (!$request->isMethod('post')) {
            return view('addRecipe', ['recipe' => $recipe]);
        }

        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->save();
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
        $recipe = Recipe::where('id', $id)->first()->toArray();
        if (!$request->isMethod('post')) {
            return view('addRecipe', ['recipe' => $recipe]);

        }

        Recipe::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
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
