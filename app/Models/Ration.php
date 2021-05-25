<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

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
            self::AVAILABLE => '<span class="badge bg-success">DISPONIBLE</span>',
            self::NO_AVAILABLE => '<span class="badge bg-gray">NO DISPONIBLE</span>',
            self::EXPIRED => '<span class="badge bg-danger">EXPIRADO</span>'
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
        return $this->belongsToMany(\App\Models\User::class)->withPivot('rations', 'status')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reserved()
    {
        return $this->users()->select('rations.*')->where('status', Reservation::ESTADO_RESERVACION_APROBADA)->sum('rations');
    }

    public static function hasAvailableWithDate($today, $day)
    {
        $year = Carbon::create($today)->year;
        $month = Carbon::create($today)->month;
        $date = Carbon::create($year, $month, $day)->format('Y-m-d');
        return DB::table('rations')->where('available_at', $date)->exists();
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
        if ($this->reserved() < $this->qty) return self::AVAILABLE;
        else return self::NO_AVAILABLE;
    }

    public static function getRecipeSlugWithLink($route, $ration) {
        $params = array(
            'year' => $ration->available_at->year,
            'month' => $ration->available_at->month,
            'day' => $ration->available_at->day,
            'slug' => $ration->recipe->slug
        );
        return '<a href="'.route($route, $params).'" target="_blank">'.$ration->recipe->name.'</a>';
    }

    public function openRationReservation()
    {
        $params = array(
            'year' => $this->available_at->year,
            'month' => $this->available_at->month,
            'day' => $this->available_at->day,
            'slug' => $this->recipe->slug
        );
        return '<a class="btn btn-sm btn-link" href="'. \backpack_url('/ration', $params) .'"><i class="fas fa-users"></i> Participantes </a>';
    }


}
