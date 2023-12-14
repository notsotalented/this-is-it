<?php

namespace App\Http\Controllers\Admin;

use App\Containers\User\Models\User;
use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
  use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

  public function setup()
  {
    $this->crud->setModel(User::class);
    $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
    $this->crud->setEntityNameStrings('user', 'users');
  }

  protected function setupListOperation()
  {
    // TODO: remove setFromDb() and manually define Columns, maybe Filters

    $this->crud->setFromDb();

    $this->crud->addColumn([
      'name' => 'created_at',
      'type' => 'date',
      'label' => 'Publish_date',
    ]);
  }

  protected function setupCreateOperation()
  {
    $this->crud->setValidation(UserRequest::class);
    // TODO: remove setFromDb() and manually define Fields
    $this->crud->setFromDb();
  }

  protected function setupUpdateOperation()
  {
    $this->setupCreateOperation();
  }
}
