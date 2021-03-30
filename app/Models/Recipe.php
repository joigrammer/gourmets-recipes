<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'user_id'
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
    
    public function __construct(array $attributes = [])
    {           
        $this->creating([$this, 'onCreating']);
        parent::__construct($attributes);
    }

    public function onCreating(Recipe $row)
    {        
        if (!Auth::id()) {
            return false;
        }
        $row->setAttribute('user_id', Auth::id());
    }
    
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(\App\Models\Ingredient::class);
    }
    // TODO: No funciona el distinct, coge todos los alergenos aún cuando están repetidos
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
    
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            Storage::delete(Str::replaceFirst('storage/','public/', $obj->image));
        });
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "public/recipes";

        if ($value==null) {
            Storage::delete($this->{$attribute_name});

            $this->attributes[$attribute_name] = null;
        }

        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('jpg', 90);

            $filename = md5($value.time()).'.jpg';

            Storage::put($destination_path.'/'.$filename, $image->stream());

            Storage::delete(Str::replaceFirst('storage/','public/', $this->{$attribute_name}));

            $public_destination_path = Str::replaceFirst('public/', 'storage/', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }
}
