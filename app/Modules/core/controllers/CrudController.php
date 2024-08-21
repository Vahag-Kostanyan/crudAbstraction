<?php


namespace App\Modules\core\controllers;

use App\Http\Controllers\Controller;
use App\Modules\core\traits\CrudControllerTrait;
use Illuminate\Http\JsonResponse;
use App\Modules\core\interfaces\CrudControllerInterface;
use App\Modules\core\requests\BaseRequest;
use Illuminate\Database\Eloquent\Model;


abstract class CrudController extends Controller implements CrudControllerInterface
{
    use CrudControllerTrait;

    protected const METHOD_INDEX = "index";
    protected const METHOD_SHOW = "show";
    protected const METHOD_STORE = "store";
    protected const METHOD_UPDATE = "update";
    protected const METHOD_DESTROY = "destroy";
    protected $modelClass;
    protected ?Model $model;
    protected ?array $searchField = [];
    protected ?array $allowedIncludes = [];
    protected $indexRequestClass;
    protected $showRequestClass;
    protected $storeRequestClass;
    protected $updateRequestClass;
    protected $destroyRequestClass;
    protected $indexServiceClass;
    protected $showServiceClass;
    protected $storeServiceClass; 
    protected $updateServiceClass;
    protected $destroyServiceClass;
    protected $indexService;
    protected $showService;
    protected $storeService; 
    protected $updateService;
    protected $destroyService;
    protected $crudService;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->model = app($this->modelClass);
        $this->setServices();
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse
    {
        $this->validation($request, $this->indexRequestClass);

        if($this->indexService){
            return response()->json($this->indexService->index($request, $this->model, $this->searchField));
        }
        
        return response()->json($this->crudService->index($request, $this->model, $this->searchField));
    }


    /**
     * Summary of show
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->showRequestClass, $id);

        if($this->showService){
            return response()->json($this->showService->show($request, $this->model, $id));
        }

        return response()->json($this->crudService->show($request, $this->model, $id));
    }


    /**
     * Summary of store
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function store(BaseRequest $request): JsonResponse
    {
        $this->validation($request, $this->storeRequestClass);

        if($this->storeService){
            return response()->json($this->storeService->store($request, $this->model));
        }

        return response()->json($this->crudService->store($request, $this->model));
    }


    /**
     * Summary of update
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->updateRequestClass, $id);

        if($this->updateService){
            return response()->json($this->updateService->update($request, $this->model, $id));
        }

        return response()->json($this->crudService->update($request, $this->model, $id));
    }


    /**
     * Summary of destroy
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->destroyRequestClass, $id);

        if($this->destroyService){
            return response()->json($this->destroyService->destroy($request, $this->model, $id));
        }

        return response()->json($this->crudService->destroy($request, $this->model, $id));
    }
}
