<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RationRequest;
use App\Models\Ration;
use App\Models\Recipe;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class RationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function store()
    {
        $user = User::find(backpack_auth()->user()->id);
        $params = $this->crud->getRequest()->request->all();
        $servings = json_decode($params['servings'], true);
        foreach ($servings as $key => $value) {
            $servings[$key]['available_at'] = $params['available_at'];
        }
        $user->servings()->createMany($servings);
        \Alert::success(trans('backpack::crud.insert_success'))->flash();
        return \Redirect::to($this->crud->route);
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Ration::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ration');
        CRUD::setEntityNameStrings('ration', 'rations');
        CRUD::orderBy('available_at', 'desc');
        CRUD::enableDetailsRow();
    }

    public function showDetailsRow($id)
    {
        $ration = Ration::find($id);
        return view('vendor.backpack.crud.rations.details_row.users', compact('ration'));
        //CRUD::setDetailsRowView('vendor.backpack.crud.rations.details_row.users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::addColumn([
            'name' => 'available_at',
            'label' => 'Fecha',
            'type' => 'date',
            'format' => 'DD/MM/YYYY'
        ]);

        CRUD::addColumn([
            'name' => 'week_name',
            'label' => 'Día',
            'type' => 'date',
            'format' => 'dddd'
        ]);

        CRUD::addColumn([
            'name' => 'available_ration',
            'label' => 'Raciones'
        ]);

        CRUD::addColumn([
            'name' => 'url',
            'label' => 'Recipe',
            'type' => 'closure',
            'function' => function($ration) {
                return Recipe::getSlugWithLink('recipes.show', $ration->recipe->slug);
            }
        ]);

        CRUD::addColumn([
            'name' => 'status_code',
            'label' => 'Estado',
            'type' => 'closure',
            'function' => function($ration) {
                return Ration::getSpanStatusFromCodeName()[$ration->status_code];
            }
        ]);

        CRUD::addFilter([
            'type' => 'date_range',
            'name' => 'from_to',
            'label' => 'Date range'
        ],
        false,
        function ($value) {
            $dates = json_decode($value);
            $this->crud->addClause('where', 'available_at', '>=', $dates->from);
            $this->crud->addClause('where', 'available_at', '<=', $dates->to);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RationRequest::class);

        CRUD::addField([
            'name' => 'available_at',
            'type' => 'date_picker',
            'date_picker_options' => [
                'todayBtn' => 'linked',
                'format'   => 'dd-mm-yyyy',
             ],
        ]);

        CRUD::addField([
            'name' => 'servings',
            'type' => 'repeatable',
            'fields' => [
                [
                    'name' => 'qty',
                    'label' => '',
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name' => 'recipe_id',
                    'label' => '',
                    'type' => 'select2',
                    'entity' => 'recipes',
                    'wrapper' => ['class' => 'form-group col-md-10'],
                ]
            ]
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(RationRequest::class);

        CRUD::addField([
            'name' => 'available_at',
            'label' => 'Fecha pautada para:',
            'type' => 'date_picker',
            'date_picker_options' => [
                'todayBtn' => 'linked',
                'format'   => 'dd-mm-yyyy',
             ],
        ]);

        CRUD::addField([
            'name' => 'qty',
            'type' => 'text',
            'label' => 'Cant. Raciones'
        ]);

        CRUD::addField([
            'name' => 'recipe_id',
            'type' => 'select2',
            'entify' => 'Receta'
        ]);
    }
}
