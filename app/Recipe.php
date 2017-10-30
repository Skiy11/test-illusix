<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'recipes';
    protected $fillable = [
        'id',
        'title',
        'description'
    ];

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('ingredient_id', 'recipe_id', 'quantity');
    }
}
