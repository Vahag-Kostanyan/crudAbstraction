<?php

namespace App\Modules\core\services\crud;

use App\Modules\core\interfaces\crud\IndexInterface;
use App\Modules\core\requests\crud\BaseIndexRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseIndexService implements IndexInterface
{
    /**
     * Summary of index
     * @param BaseIndexRequest $request
     * @param Model $model
     * @return array
     */
    public function index(BaseIndexRequest $request, Model $model, array $searchField): array
    {
        try {
            $query = $model->query();

            if ($request->has('include')) {
                $include = explode('&', $request->input('include'));
                $query->with($include);
            }

            if ($request->has('search') && count($searchField)) {
                if (count($searchField) == 1) {
                    $query->where($searchField[0], 'like', '%' . $request->input('search') . '%');
                } else {
                    $query->where(function ($query) use ($searchField, $request) {
                        foreach ($searchField as $key => $item) {
                            if ($key == 0) {
                                $query->where($item, 'like', '%' . $request->input('search') . '%');
                            } else {
                                $query->orWhere($item, 'like', '%' . $request->input('search') . '%');
                            }
                        }
                    });
                }
            }

            if ($request->has('sortBy')) {
                $query->orderBy($request->input('sortBy'), $request->input('sortDir') ?? 'asc');
            }

            if ($request->has('limit')) {
                $query->limit($request->input('limit'));
                if ($request->has('page')) {
                    $query->offset($request->input('limit') * ($request->input('page') - 1));
                }
            }

            return [
                'data' => $query->get(),
                'totalData' => $query->count(),
                'limit' => $request->input('limit') ?? null,
                'page' => $request->input('page') ?? null,
            ];
        } catch (Exception $ex) {
            serverException();
        }
    }
}
