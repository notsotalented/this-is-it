<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');

    }

    protected function setupListOperation()
    {

        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();

        $this->crud->enableExportButtons();

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TagRequest::class);
        //dump($this->crud);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();


        dump($this->crud);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
