<?php
 

namespace App\Modules\example\controllers;

use App\Models\Example;
use App\Models\User;
use App\Modules\core\controllers\CrudController;
use App\Modules\example\requests\StoreRequest;
use App\Modules\example\services\ShowService;

class ExampleController extends CrudController
{
    protected $modelClass = Example::class;
    protected $storeRequestClass = StoreRequest::class;
    protected $showServiceClass = ShowService::class;
}