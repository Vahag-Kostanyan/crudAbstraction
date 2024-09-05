<?php


namespace App\Modules\core\controllers;

use App\Http\Controllers\Controller;
use App\Modules\core\traits\CrudControllerTrait;
use Illuminate\Http\JsonResponse;
use App\Modules\core\interfaces\CrudControllerInterface;
use App\Modules\core\requests\BaseRequest;
use App\Modules\core\requests\crud\BaseIndexRequest;
use App\Modules\core\requests\crud\BaseUpdateRequest;
use App\Modules\core\requests\crud\BaseDeleteRequest;
use App\Modules\core\requests\crud\BaseShowRequest;
use App\Modules\core\requests\crud\BaseStoreRequest;
use App\Modules\core\services\CrudService;
use Illuminate\Database\Eloquent\Model;


abstract class CrudController extends Controller implements CrudControllerInterface
{
    use CrudControllerTrait;

    protected const METHOD_INDEX = "index";
    protected const METHOD_SHOW = "show";
    protected const METHOD_STORE = "store";
    protected const METHOD_UPDATE = "update";
    protected const METHOD_DESTROY = "destroy";
    protected string $modelClass = Model::class;
    protected ?Model $model;
    protected array $searchField = [];
    protected array $allowedIncludes = [];
    protected string $indexRequestClass = BaseIndexRequest::class;
    protected string $showRequestClass = BaseShowRequest::class;
    protected string $storeRequestClass = BaseStoreRequest::class;
    protected string $updateRequestClass = BaseUpdateRequest::class;
    protected string $destroyRequestClass = BaseDeleteRequest::class;
    protected $indexServiceClass;
    protected $showServiceClass;
    protected $storeServiceClass; 
    protected $updateServiceClass;
    protected $destroyServiceClass;
    protected $crudService;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->model = app($this->modelClass);
        $this->crudService = new CrudService();
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse
    {
        $this->validation($request, $this->indexRequestClass);

        if($this->indexServiceClass){
            return response()->json(app($this->indexServiceClass)->index($request, $this->model, $this->searchField));
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

        if($this->showServiceClass){
            return response()->json(app($this->showServiceClass)->show($request, $this->model, $id));
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

        if($this->storeServiceClass){
            return response()->json(app($this->storeServiceClass)->store($request, $this->model));
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

        if($this->updateServiceClass){
            return response()->json(app($this->updateServiceClass)->update($request, $this->model, $id));
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

        if($this->destroyServiceClass){
            return response()->json(app($this->destroyServiceClass)->destroy($request, $this->model, $id));
        }

        return response()->json($this->crudService->destroy($request, $this->model, $id));
    }
}
