<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $table = 'ration_user';

    protected $fillable = [
        'status'
    ];

    const ESTADO_RESERVACION_PENDIENTE = 'PEN';
    const ESTADO_RESERVACION_APROBADA = 'APR';
    const ESTADO_RESERVACION_RECHAZADA = 'RCH';

    public static function getEstadosReservacion()
    {
        return array(
            self::ESTADO_RESERVACION_PENDIENTE => 'PENDIENTE',
            self::ESTADO_RESERVACION_APROBADA => 'APROBADA',
            self::ESTADO_RESERVACION_RECHAZADA => 'RECHAZADA'
        );
    }

    public static function getSpanStatusFromCodeName(): array
    {
        return array(
            self::ESTADO_RESERVACION_PENDIENTE => '<span class="badge bg-gray">PENDIENTE</span>',
            self::ESTADO_RESERVACION_APROBADA => '<span class="badge bg-success">APROBADA</span>',
            self::ESTADO_RESERVACION_RECHAZADA => '<span class="badge bg-danger">RECHAZADA</span>'
        );
    }

    public function ration()
    {
        return $this->belongsTo(\App\Models\Ration::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
