<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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
        'extrack',
        'starting_at',
        'finished_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'starting_at' => 'datetime',
        'finished_at' => 'datetime',
    ];


    public function reservations()
    {
        return $this->belongsToMany(\App\Models\Reservation::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(\App\Models\Recipe::class);
    }
}
