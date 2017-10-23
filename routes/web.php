<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/recipe-list', 'RecipeController@recipeList')->name('recipe-list');
Route::match(array('GET', 'POST'), 'add-recipe', 'RecipeController@addRecipe')->name('add-recipe');
Route::get('/show-recipe/{id}', 'RecipeController@showRecipe')->name('show-recipe');
Route::match(array('GET', 'POST'), 'update-recipe/{id}', 'RecipeController@updateRecipe')->name('update-recipe');
Route::get('/remove-recipe/{id}', 'RecipeController@removeRecipe')->name('remove-recipe');

Route::get('/ingredient-list', 'IngredientController@ingredientList')->name('ingredient-list');
Route::match(array('GET', 'POST'), 'add-ingredient', 'IngredientController@addIngredient')->name('add-ingredient');
Route::match(array('GET', 'POST'), 'update-ingredient/{id}', 'IngredientController@updateIngredient')->name('update-ingredient');
Route::get('/remove-ingredient/{id}', 'IngredientController@removeIngredient')->name('remove-ingredient');
