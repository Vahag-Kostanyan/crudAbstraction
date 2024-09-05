<?php

namespace App\Modules\core\interfaces\crud;

use App\Modules\core\requests\crud\BaseStoreRequest;
use Illuminate\Database\Eloquent\Model;

interface StoreInterface
{
    /**
     * Summary of store
     * @param BaseStoreRequest $request
     * @param Model $model
     * @return array
     */
    public function store(BaseStoreRequest $request, Model $model): array;
}