<?php

namespace App\Modules\core\services;

use App\Modules\core\requests\BaseRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CrudService
{
    /**
     * Summary of index
     * @param BaseRequest $request
     * @param Model $model
     * @return array
     */
    public function index(BaseRequest $request, Model $model, array $searchField): array
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

    /**
     * Summary of show
     * @param BaseRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function show(BaseRequest $request, Model $model, int|string $id): array
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


    /**
     * Summary of show
     * @param BaseRequest $request
     * @param Model $model
     * @return array
     */
    public function store(BaseRequest $request, Model $model): array
    {
        try {
            $record = $model->create($request->all());

            return ['data' => $record, 'message' => 'Updated successfully'];
        } catch (Exception $ex) {
            serverException();
        }
    }


    /**
     * Summary of show
     * @param BaseRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function update(BaseRequest $request, Model $model, int|string $id): array
    {
        try {
            $record = $model->find($id);

            if ($record) {
                foreach ($request->all() as $key => $value) {
                    if (array_key_exists($key, $record->getAttributes())) {
                        $record->{$key} = $value; // Update the attribute with the new value
                    }
                }
            }

            $record->save();

            return ['data' => $record, 'message' => 'Updated successfully'];
        } catch (Exception $ex) {
            serverException();
        }
    }

    /**
     * Summary of show
     * @param BaseRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function destroy(BaseRequest $request, Model $model, int|string $id): array
    {
        try {
            $model->find($id)->delete();

            return ['message' => 'Deleted successfully'];
        } catch (Exception $ex) {
            serverException();
        }
    }
}
