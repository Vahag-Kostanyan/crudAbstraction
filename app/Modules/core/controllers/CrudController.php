<?php


namespace App\Modules\core\controllers;

use App\Http\Controllers\Controller;
use App\Modules\core\services\crud\BaseShowService;
use App\Modules\core\traits\CrudControllerTrait;
use Illuminate\Http\JsonResponse;
use App\Modules\core\interfaces\CrudControllerInterface;
use App\Modules\core\requests\BaseRequest;
use App\Modules\core\requests\crud\BaseIndexRequest;
use App\Modules\core\requests\crud\BaseUpdateRequest;
use App\Modules\core\requests\crud\BaseDestroyRequest;
use App\Modules\core\requests\crud\BaseShowRequest;
use App\Modules\core\requests\crud\BaseStoreRequest;
use App\Modules\core\services\crud\BaseDestroyService;
use App\Modules\core\services\crud\BaseIndexService;
use App\Modules\core\services\crud\BaseStoreService;
use App\Modules\core\services\crud\BaseUpdateService;
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
    protected string $destroyRequestClass = BaseDestroyRequest::class;
    protected string $indexServiceClass = BaseIndexService::class;
    protected string $showServiceClass = BaseShowService::class;
    protected string $storeServiceClass = BaseStoreService::class;
    protected string $updateServiceClass = BaseUpdateService::class;
    protected string $destroyServiceClass = BaseDestroyService::class;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->model = app($this->modelClass);
    }


    /**
     * Summary of index
     * @param BaseIndexRequest $request
     * @return JsonResponse
     */
    public function index(BaseIndexRequest $request): JsonResponse
    {
        $this->validation($request, $this->indexRequestClass);

        return response()->json(app($this->indexServiceClass)->index($request, $this->model, $this->searchField));
    }


    /**
     * Summary of show
     * @param BaseShowRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(BaseShowRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->showRequestClass, $id);

        return response()->json(app($this->showServiceClass)->show($request, $this->model, $id));
    }


    /**
     * Summary of store
     * @param BaseStoreRequest $request
     * @return JsonResponse
     */
    public function store(BaseStoreRequest $request): JsonResponse
    {
        $this->validation($request, $this->storeRequestClass);

        return response()->json(app($this->storeServiceClass)->store($request, $this->model));
    }


    /**
     * Summary of update
     * @param BaseUpdateRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(BaseUpdateRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->updateRequestClass, $id);

        return response()->json(app($this->updateServiceClass)->update($request, $this->model, $id));
    }


    /**
     * Summary of destroy
     * @param BaseDestroyRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(BaseDestroyRequest $request, int|string $id): JsonResponse
    {
        $this->validation($request, $this->destroyRequestClass, $id);

        return response()->json(app($this->destroyServiceClass)->destroy($request, $this->model, $id));
    }
}
