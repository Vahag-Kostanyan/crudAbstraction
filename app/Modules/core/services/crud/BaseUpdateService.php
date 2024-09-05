<?php

namespace App\Modules\core\services\crud;

use App\Modules\core\interfaces\crud\UpdateInterface;
use App\Modules\core\requests\crud\BaseUpdateRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseUpdateService implements UpdateInterface
{

    /**
     * Summary of update
     * @param BaseUpdateRequest $request
     * @param Model $model
     * @param int|string $id
     * @return array
     */
    public function update(BaseUpdateRequest $request, Model $model, int|string $id): array
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
}
