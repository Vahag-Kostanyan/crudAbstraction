<?php


namespace App\Modules\core\controllers;

use App\Http\Controllers\Controller;
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
    protected string $modelClass;
    protected Model $model;
    protected array $searchField = [];
    protected array $allowedIncludes = [];
    protected string $indexRequestClass;
    protected string $showRequestClass;
    protected string $storeRequestClass;
    protected string $updateRequestClass;
    protected string $destroyRequestClass;

    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse
    {
        $this->validate($request, $this->indexRequestClass);

        return response()->json([]);
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validate($request, $this->showRequestClass);

        return response()->json([]);
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function store(BaseRequest $request): JsonResponse
    {
        $this->validate($request, $this->storeRequestClass);

        return response()->json([]);
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validate($request, $this->updateRequestClass);

        return response()->json([]);
    }


    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(BaseRequest $request, int|string $id): JsonResponse
    {
        $this->validate($request, $this->destroyRequestClass);

        return response()->json([]);
    }
}
