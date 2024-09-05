<?php

namespace App\Modules\core\interfaces\crud;

use App\Modules\core\requests\crud\BaseDestroyRequest;
use Illuminate\Database\Eloquent\Model;

interface DestroyInterface
{
    /**
     * Summary of destroy
     * @param BaseDestroyRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function destroy(BaseDestroyRequest $request, Model $model, int|string $id): array;
}
