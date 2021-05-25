<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function rations()
    {
        return $this->belongsToMany(Ration::class)->withPivot('rations');
    }

    public function servings()
    {
        return $this->hasMany(\App\Models\Ration::class);
    }

    public function hasRation($id)
    {
        return $this->rations()->where('ration_id', $id)->first();
    }

    public function getMyReservedInRation($id)
    {
        return $this->rations()->select('rations')->where('ration_id', $id)->sum('rations');
    }

    public function getMyRationApproved($id)
    {
        return $this->rations()->select('rations')->where('ration_user.ration_id', $id)->where('ration_user.status', Reservation::ESTADO_RESERVACION_APROBADA)->sum('ration_user.rations');
    }

}
