<?php

namespace App\Modules\core\services\crud;

use App\Modules\core\interfaces\crud\ShowInterface;
use App\Modules\core\requests\crud\BaseShowRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseShowService implements ShowInterface
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
            $query = $model->query();

            $query->where('id', $id);

            if ($request->has('include')) {
                $include = explode('&', $request->input('include'));
                $model->with($include);
            }

            return [
                'data' => $query->first(),
            ];
        } catch (Exception $ex) {
            serverException();
        }
    }

}
