<?php
 

namespace App\Modules\example\controllers;

use App\Models\User;
use App\Modules\core\controllers\CrudController;
use App\Modules\example\requests\IndexRequest;
use App\Modules\example\services\IndexService;

class ExampleController extends CrudController
{
    protected $modelClass = User::class;
    protected $indexRequestClass = IndexRequest::class;
    protected $indexServiceClass = IndexService::class;
}