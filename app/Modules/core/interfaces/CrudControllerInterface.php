<?php


namespace App\Modules\core\interfaces;

use App\Modules\core\requests\crud\BaseDestroyRequest;
use App\Modules\core\requests\crud\BaseIndexRequest;
use App\Modules\core\requests\crud\BaseShowRequest;
use App\Modules\core\requests\crud\BaseStoreRequest;
use App\Modules\core\requests\crud\BaseUpdateRequest;
use Illuminate\Http\JsonResponse;

interface CrudControllerInterface
{
    /**
     * Summary of index
     * @param BaseIndexRequest $request
     * @return JsonResponse
     */
    public function index(BaseIndexRequest $request): JsonResponse;

    /**
     * Summary of index
     * @param BaseShowRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(BaseShowRequest $request, int|string $id): JsonResponse;

    /**
     * Summary of index
     * @param BaseStoreRequest $request
     * @return JsonResponse
     */
    public function store(BaseStoreRequest $request): JsonResponse;

    /**
     * Summary of index
     * @param BaseUpdateRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(BaseUpdateRequest $request, int|string $id): JsonResponse;

    /**
     * Summary of index
     * @param BaseDestroyRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(BaseDestroyRequest $request, int|string $id): JsonResponse;
}