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
    protected $fillable = ['available_at', 'qty', 'recipe_id', 'user_id'];
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

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reserved()
    {
        return $this->users()->select('rations')->sum('rations');
    }

    public function available()
    {
        return $this->qty - $this->reserved();
    }

    public function hasExpired()
    {
        return $this->available_at < Carbon::now();
    }

    public function getWeekNameAttribute()
    {
        return Carbon::create($this->available_al);
    }

    public function getAvailableRationAttribute()
    {
        return $this->reserved() . "/" . $this->available();
    }

    public function getStatusAttribute()
    {
        return !$this->hasExpired();
    }
}
