<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
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
     * Get list with ingredients
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ingredientList()
    {
        $ingredients = Ingredient::orderBy('id', 'desc')->get();
        return view('ingredient', ['ingredients' => $ingredients]);
    }

    /**
     * Add new ingredient
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addIngredient(Request $request)
    {
        $ingredient = ['id' => '', 'title' => ''];
        if (!$request->isMethod('post')) {
            return view('addIngredient', ['ingredient' => $ingredient]);
        }

        $recipe = new Ingredient();
        $recipe->title = $request->input('title');
        $recipe->save();
        return redirect('ingredient-list');
    }

    /**
     * Update ingredient
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function updateIngredient($id, Request $request)
    {
        $ingredient = Ingredient::where('id', $id)->first()->toArray();
        if (!$request->isMethod('post')) {
            return view('addIngredient', ['ingredient' => $ingredient]);

        }

        Ingredient::where('id', $id)->update([
            'title' => $request->input('title'),
        ]);
        return redirect('ingredient-list');
    }

    /**
     * Remove ingredient
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeIngredient($id)
    {
        Ingredient::where('id', $id)->delete();
        return redirect('ingredient-list');
    }
}
