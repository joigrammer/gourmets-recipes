<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function store(StoreRecipeRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $tags = $request->get('tags');
            $ingredients = json_decode($request->get('ingredients'), true);
            $recipe = Recipe::create($data);
            if ($request->hasFile('image')) {
                $recipe->image = $request->file('image')->store('public/img/recipes');
                $recipe->save();
            }
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

    public function update(UpdateRecipeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $recipe = Recipe::find($id);
            $data = $request->all();
            $tags = $request->get('tags');
            $ingredients = json_decode($request->get('ingredients'), true);
            if ($request->hasFile('image')) {
                Storage::delete($recipe->image);
                $data['image'] = $request->file('image')->store('public/img/recipes');
            }
            $recipe->update($data);
            $recipe->tags()->sync($tags);
            $recipe->ingredients()->sync($ingredients);
            DB::commit();
            \Alert::success(trans('backpack::crud.insert_success'))->flash();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return \Redirect::to($this->crud->route);
    }

    public function setup()
    {
        CRUD::setModel(\App\Models\Recipe::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipe');
        CRUD::setEntityNameStrings('recipe', 'recipes');
        CRUD::enableDetailsRow();
    }

    public function showDetailsRow($id)
    {
        $recipe = Recipe::find($id);
        return view('vendor.backpack.crud.recipes.details_row.ingredients', compact('recipe'));
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'allergens',
            'label' => 'Contain'
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'created at',
            'type' => 'date'
        ]);

        CRUD::addColumn([
            'name' => 'user.name',
            'label' => 'User',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'ingredients',
            'label' => 'Ingredients',
            'type' => 'array_count',
            'suffix' => 'Ingredients'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->enableTabs();
        $this->crud->enableHorizontalTabs();

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'name' => 'slug',
            'type' => 'text',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'name' => 'meal_id',
            'type' => 'select2',
            'entity' => 'meal',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'name' => 'tags',
            'type' => 'select2_multiple',
            'entity' => 'tags',
            'tab' => 'Recipe'
        ]);


        CRUD::addField([
            'name' => 'extract',
            'type' => 'textarea',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'name' => 'body',
            'type' => 'ckeditor',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'type' => 'upload',
            'name' => 'image',
            'label' => 'Image',
            'upload' => true,
            'disk' => 'public',
            'tab' => 'Recipe'
        ]);

        CRUD::addField([
            'name' => 'ingredients',
            'label' => 'Ingredients',
            'type' => 'repeatable',
            'tab' => 'Ingredients',
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
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
