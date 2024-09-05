<?php

namespace App\Modules\core\interfaces\crud;

use App\Modules\core\requests\crud\BaseIndexRequest;
use Illuminate\Database\Eloquent\Model;

interface IndexInterface
{
    /**
     * Summary of index
     * @param BaseIndexRequest $request
     * @param Model $model
     * @param array $searchField
     * @return array
     */
    public function index(BaseIndexRequest $request, Model $model, array $searchField): array;
}