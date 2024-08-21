<?php


namespace App\Modules\core\controllers;

use App\Http\Controllers\Controller;
use App\Modules\core\services\CrudService;
use App\Modules\core\traits\ValidationTrait;
use Illuminate\Http\JsonResponse;
use App\Modules\core\interfaces\CrudControllerInterface;
use App\Modules\core\requests\BaseRequest;
use Illuminate\Database\Eloquent\Model;


abstract class CrudController extends Controller implements CrudControllerInterface
{
    use ValidationTrait;

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
    protected $crudService;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->crudService = new CrudService();
        $this->model = app($this->modelClass);
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse
    {
        $this->validation($request, $this->indexRequestClass);

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

        return response()->json($this->crudService->destroy($request, $this->model, $id));
    }
}
