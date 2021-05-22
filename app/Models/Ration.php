<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Ration extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    const EXPIRED = 'EXPIRED';
    const AVAILABLE = 'AVAILABLE';
    const NO_AVAILABLE = 'NO_AVAILABLE';

    protected $table = 'rations';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['available_at', 'qty', 'recipe_id', 'user_id'];
    protected $casts = [
        'available_at' => 'date:d-m-Y'
    ];

    public static function getSpanStatusFromCodeName(): array
    {
        return array(
            self::NO_AVAILABLE => '<span class="badge bg-success">Disponible</span>',
            self::AVAILABLE => '<span class="badge bg-gray">No Disponible</span>',
            self::EXPIRED => '<span class="badge bg-danger">Expirado</span>'
        );
    }

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
        return $this->available_at;
    }

    public function getAvailableRationAttribute()
    {
        return $this->reserved() . "/" . $this->qty;
    }

    public function getStatusAttribute()
    {
        return !$this->hasExpired();
    }

    public function getStatusCodeAttribute()
    {
        if ($this->hasExpired()) return self::EXPIRED;
        if ($this->available() < $this->qty) return self::AVAILABLE;
        else return self::NO_AVAILABLE;
    }
}
