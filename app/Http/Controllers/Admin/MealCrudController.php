<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MealRequest;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Models\Meal;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class MealCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MealCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function store(StoreMealRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $meal = Meal::create($data);
            if ($request->hasFile('image')) {
                $meal->image = $request->file('image')->store('public/icons/meals');
                $meal->save();
            }
            DB::commit();
            \Alert::success(trans('backpack::crud.insert_success'))->flash();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return \Redirect::to($this->crud->route);
    }

    public function update(UpdateMealRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $meal = Meal::find($id);
            $data = $request->all();
            if ($request->hasFile('image')) {
                Storage::delete($meal->image);
                $data['image'] = $request->file('image')->store('public/icons/meals');
            }
            $meal->update($data);
            DB::commit();
            \Alert::success(trans('backpack::crud.insert_success'))->flash();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return \Redirect::to($this->crud->route);
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Meal::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/meal');
        CRUD::setEntityNameStrings('meal', 'meals');
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
            'name' => 'name',
            'type' => 'text',
        ]);

        // TODO: Algunas imágenes desaparecen al definir el estilo float, y con disk se posicionan de otra forma
        CRUD::addColumn([
            'name' => 'image',
            'type' => 'image',
            'disk' => 'local',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MealRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'slug',
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea'
        ]);

        CRUD::addField([
            'type' => 'upload',
            'name' => 'image',
            'label' => 'Image',
            'upload' => true,
            'disk' => 'public',
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
        $this->setupCreateOperation();
    }
}
