<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
    ];

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }

    public function allergens()
    {
        return $this->belongsToMany(\App\Models\Allergen::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_measurement_recipe')->withPivot('amount', 'annotation', 'measurement_id');
    }

    public function measurements()
    {
        return $this->belongsToMany(Measurement::class, 'ingredient_measurement_recipe')->withPivot('amount', 'annotation', 'recipe_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
