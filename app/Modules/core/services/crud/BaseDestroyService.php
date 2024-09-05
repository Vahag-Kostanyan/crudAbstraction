<?php

namespace App\Modules\core\services\crud;

use App\Modules\core\interfaces\crud\DestroyInterface;
use App\Modules\core\requests\crud\BaseDestroyRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseDestroyService implements DestroyInterface
{


    /**
     * Summary of show
     * @param BaseDestroyRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function destroy(BaseDestroyRequest $request, Model $model, int|string $id): array
    {
        try {
            $model->find($id)->delete();

            return ['message' => 'Deleted successfully'];
        } catch (Exception $ex) {
            serverException();
        }
    }
}