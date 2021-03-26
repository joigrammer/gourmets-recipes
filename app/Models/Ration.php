<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Ration extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'rations';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['available_at', 'qty', 'recipe_id'];
    protected $casts = [
        'available_at' => 'date:d-m-Y'
    ];

    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class);
    }

    public function recipes()
    {
        return $this->hasMany(\App\Models\Recipe::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withPivot('rations');
    }

    public function reserved()
    {
        return $this->users()->select('rations')->sum('rations');
    }

    public function available()
    {
        return $this->qty - $this->reserved();
    }

    public function isExpired()
    {
        return $this->available_at < Carbon::now();
    }
}
