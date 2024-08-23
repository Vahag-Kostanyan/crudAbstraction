<?php


namespace App\Modules\example\services;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Database\Eloquent\Model;

class IndexService
{
    /**
     * Summary of index
     * @param BaseRequest $request
     * @param Model $model
     * @return array
     */
    public function index(BaseRequest $request, Model $model, array $searchField): array {
        return [];
    }
}
