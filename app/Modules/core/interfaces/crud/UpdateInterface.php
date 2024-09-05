<?php

namespace App\Modules\core\interfaces\crud;

use App\Modules\core\requests\crud\BaseUpdateRequest;
use Illuminate\Database\Eloquent\Model;

interface UpdateInterface
{
    /**
     * Summary of update
     * @param BaseUpdateRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function update(BaseUpdateRequest $request, Model $model, int|string $id): array;
}
