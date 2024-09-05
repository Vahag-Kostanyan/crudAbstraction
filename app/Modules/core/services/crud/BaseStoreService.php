<?php

namespace App\Modules\core\services\crud;

use App\Modules\core\interfaces\crud\StoreInterface;
use App\Modules\core\requests\crud\BaseStoreRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseStoreService implements StoreInterface
{
    /**
     * Summary of store
     * @param BaseStoreRequest $request
     * @param Model $model
     * @return array
     */
    public function store(BaseStoreRequest $request, Model $model): array
    {
        try {
            $record = $model->create($request->all());

            return ['data' => $record, 'message' => 'Created successfully'];
        } catch (Exception $ex) {
            serverException();
        }
    }
}
