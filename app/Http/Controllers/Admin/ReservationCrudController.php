<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipe;
use App\Models\Reservation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReservationCrudController extends CrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    public function setup()
    {
        $year = \Route::current()->parameter('year');
        $month = \Route::current()->parameter('month');
        $day = \Route::current()->parameter('day');
        $slug = \Route::current()->parameter('slug');
        CRUD::setModel(\App\Models\Reservation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . "/ration/{$year}/{$month}/{$day}/{$slug}");
        $recipe = Recipe::where('slug', $slug)->first();
        Log::info(var_export(\Route::current()->parameters(), true));
        $date = Carbon::create($year, $month, $day);
        $this->crud->query->select('ration_user.*');
        $this->crud->query->join('rations', 'rations.id', '=','ration_user.ration_id');
        $this->crud->query->join('recipes', 'recipes.id', '=','rations.recipe_id');
        $this->crud->query->where('recipes.slug', $slug);
        $this->crud->query->where('rations.available_at', $date->format('Y-m-d'));
        CRUD::setEntityNameStrings('reservation', "{$date->format('d-m-Y')}, {$recipe->name}");
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('update');
        $this->crud->getCurrentOperation();
        $this->crud->addButtonFromView('line', 'approve', 'approve', 'end');
        $this->crud->addButtonFromView('line', 'disapprove', 'disapprove', 'end');

        CRUD::column('user_id');

        CRUD::addColumn([
            'name' => 'rations',
            'label' => 'Raciones',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'Fecha',
            'type' => 'date',
            'format' => 'DD/MM/YYYY'
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Estado',
            'type' => 'closure',
            'function' => function($reservation) {
                return Reservation::getSpanStatusFromCodeName()[$reservation->status];
            }
        ]);

    }

    public function disapprove()
    {
        try {
            $id = \Route::current()->parameter('id');
            $reservation = Reservation::find($id);
            $reservation->update([
                'status' => Reservation::ESTADO_RESERVACION_RECHAZADA
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "errors" => [
                    "status" => $exception->getCode(),
                    "title" => $exception->getMessage()
                ]
            ], 204);
        }
    }

    public function approve()
    {
        try {
            $id = \Route::current()->parameter('id');
            $reservation = Reservation::find($id);
            $reservation->update([
                'status' => Reservation::ESTADO_RESERVACION_APROBADA
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "errors" => [
                    "status" => $exception->getCode(),
                    "title" => $exception->getMessage()
                ]
            ], 204);
        }
    }

}
