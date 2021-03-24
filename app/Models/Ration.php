<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function reserved()
    {
        return $this->users()->select([DB::raw('SUM(rations) as total')])->groupBy('ration_id')->get();
    }
}
