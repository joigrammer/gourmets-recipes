<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $category = Category::create($data);
            if ($request->hasFile('image')) {
                $category->image = $request->file('image')->store('/public/icons/categories');
                $category->save();
            }
            DB::commit();
            \Alert::success(trans('backpack::crud.insert_success'))->flash();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return \Redirect::to($this->crud->route);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $data = $request->all();
            $category->update($data);
            if ($request->hasFile('image')) {
                $category->image = $request->file('image')->store('/public/icons/categories');
                $category->save();
            }
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
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('category', 'categories');
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
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'slug',
            'type' => 'text'
        ]);

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
        //CRUD::setValidation(CategoryRequest::class);

        CRUD::field('name');
        CRUD::field('slug');

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
