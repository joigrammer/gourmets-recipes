<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class IngredientMeasurementRecipe extends Pivot
{
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
