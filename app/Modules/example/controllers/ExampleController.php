<?php
 

namespace App\Modules\example\controllers;

use App\Models\Example;
use App\Modules\core\controllers\CrudController;
use App\Modules\example\requests\StoreRequest;
use App\Modules\example\services\ShowService;

class ExampleController extends CrudController
{
    protected string $modelClass = Example::class;
    protected string $storeRequestClass = StoreRequest::class;
    protected string $showServiceClass = ShowService::class;
}