<?php
 

namespace App\Modules\example\controllers;

use App\Models\User;
use App\Modules\core\controllers\CrudController;
use App\Modules\example\requests\IndexRequest;

class ExampleController extends CrudController
{
    protected $modelClass = User::class;
    protected $indexRequestClass = IndexRequest::class;
}