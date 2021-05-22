<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Recipe extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'extract',
        'body',
        'image',
        'meal_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_measurement_recipe')->select('amount', 'annotation', 'ingredient_measurement_recipe.*')
            ->withPivot(['amount', 'annotation', 'measurement_id'])
            ->using(IngredientMeasurementRecipe::class);
    }

    public function measurements()
    {
        return $this->belongsToMany(Measurement::class, 'ingredient_measurement_recipe')
            ->withPivot('amount', 'annotation', 'ingredient_id');
    }

    public function allergens()
    {
        return $this->ingredients()
            ->select('allergens.*')
            ->join('allergen_ingredient', 'ingredients.id', '=', 'allergen_ingredient.ingredient_id')
            ->join('allergens', 'allergen_ingredient.allergen_id', '=', 'allergens.id')
            ->groupby('allergens.id')->distinct();
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(\App\Models\Reservation::class);
    }

    public function rations()
    {
        return $this->hasMany(\App\Models\Ration::class);
    }

    public function hasRationAvailable()
    {
        return $this->rations()->where(function ($query) {
            $query->where('rations.available_at', '>', Carbon::now());
        })->count();
    }

    public function hasRationAvailableInDate($date)
    {
        return $this->rations()->where(function ($query) use ($date) {
            $query->where('rations.available_at', '=', new Carbon($date));
        })->get();
    }

    public static function getSlugWithLink($route, $slug) {
        return '<a href="'.route($route, $slug).'" target="_blank">'.$slug.'</a>';
    }

    public static function getNameWithLink($route, $name) {
        return '<a href="'.route($route, $slug).'" target="_blank">'.$name.'</a>';
    }

}
