<?php

namespace App\Modules\core\interfaces\crud;

use App\Modules\core\requests\crud\BaseShowRequest;
use Illuminate\Database\Eloquent\Model;

interface ShowInterface
{
    /**
     * Summary of show
     * @param BaseShowRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function show(BaseShowRequest $request, Model $model, int|string $id): array;
}
