<?php


namespace App\Modules\example\services;

use App\Modules\core\requests\BaseRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ShowService
{
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
}
