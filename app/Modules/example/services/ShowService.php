<?php


namespace App\Modules\example\services;

use App\Modules\core\interfaces\crud\ShowInterface;
use App\Modules\core\requests\crud\BaseShowRequest;
use App\Modules\core\services\crud\BaseShowService;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ShowService extends BaseShowService implements ShowInterface
{
    /**
     * Summary of show
     * @param BaseShowRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function show(BaseShowRequest $request, Model $model, int|string $id): array
    {
        try {
            // Your functional

            return parent::show($request, $model, $id);
        } catch (Exception $ex) {
            serverException();
        }
    }
}
