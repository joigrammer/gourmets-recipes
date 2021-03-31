<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $table = 'measurements';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['name', 'abbrev'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_measurement_recipe')->withPivot('amount', 'annotation', 'recipe_id');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_measurement_recipe')->withPivot('amount', 'annotation', 'ingredient_id');
    }

    public function measurements()
    {
        return Measurement::all();
    }
}
