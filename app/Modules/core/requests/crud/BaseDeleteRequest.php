<?php

namespace  App\Modules\core\requests\crud;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Database\Eloquent\Model;

class BaseDeleteRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Summary of after_validation
     * @param int|null $id
     * @param array|null $searchField
     * @param array|null $allowedIncludes
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function after_validation(int|null $id,  array|null $searchField, array|null $allowedIncludes, Model $model): void
    {
        if (!$this->model->find($id)) {
            validationException(['id' => ['Invalid record id']]);
        }
    }
}
