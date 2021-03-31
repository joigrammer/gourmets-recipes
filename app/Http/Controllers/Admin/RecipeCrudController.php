<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRecipeRequest;
use App\Models\Recipe;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;

/**
 * Class RecipeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function store(StoreRecipeRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $tags = $request->get('tags');
            $ingredients = json_decode($request->get('ingredients'), true);
            $recipe = Recipe::create($data);
            $recipe->tags()->attach($tags);
            // TODO: Falta validar cada ingrediente que corresponda a los valores de la tabla
            $recipe->ingredients()->attach($ingredients);
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
        CRUD::setModel(\App\Models\Recipe::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipe');
        CRUD::setEntityNameStrings('recipe', 'recipes');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('slug');
        CRUD::column('extract');
        CRUD::column('body');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        //CRUD::setValidation(StoreRecipeRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text'
        ]);
        
        CRUD::addField([
            'name' => 'slug',
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'meal_id',
            'type' => 'select2',
            'entity' => 'meal'
        ]);

        /* TODO: Integrity constraint violation: 1048 Column 'recipe_id' cannot be null */
        CRUD::addField([
            'name' => 'tags',
            'type' => 'select2_multiple',
            'entity' => 'tags'
        ]);
        

        CRUD::addField([
            'name' => 'extract',
            'type' => 'textarea'
        ]);

        CRUD::addField([
            'name' => 'body',
            'type' => 'ckeditor'
        ]);
        
        CRUD::addField([
            'name' => 'ingredients',
            'label' => 'Ingredients',
            'type' => 'repeatable',
            'fields' => [                
                [
                    'name' => "amount",
                    'label' => 'amount',
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name' => 'measurement_id',
                    'type' => 'select2',
                    'model' => 'App\Models\Measurement',
                    'attribute' => 'abbrev',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name' => 'annotation',
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'ingredient_id',
                    'type' => 'select2',
                    'entity' => 'ingredients',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],                
            ]                  
        ]);


        CRUD::addField([
            'label' => "Icon",
            'name' => "image",
            'type' => 'image',
            'crop' => false, 
            'aspect_ratio' => 1,
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
