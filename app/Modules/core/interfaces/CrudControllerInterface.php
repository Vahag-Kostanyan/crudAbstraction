<?php


namespace App\Modules\core\interfaces;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Http\JsonResponse;

interface CrudControllerInterface
{
    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function index(BaseRequest $request): JsonResponse;

    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function show(BaseRequest $request, int|string $id): JsonResponse;

    /**
     * Summary of index
     * @param BaseRequest $request
     * @return JsonResponse
     */
    public function store(BaseRequest $request): JsonResponse;

    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(BaseRequest $request, int|string $id): JsonResponse;

    /**
     * Summary of index
     * @param BaseRequest $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(BaseRequest $request, int|string $id): JsonResponse;
}