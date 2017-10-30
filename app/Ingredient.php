<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ingredients';
    protected $fillable = [
        'id',
        'title',
    ];

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe')->withPivot('ingredient_id', 'recipe_id', 'quantity');
    }
}
