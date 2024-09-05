<?php

namespace App\Modules\example\requests;

use App\Modules\core\requests\crud\BaseStoreRequest;
use Illuminate\Database\Eloquent\Model;

class StoreRequest extends BaseStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
        ];
    }

    /**
     * Summary of after_validation
     * @return void
     */
    public function after_validation(int|null $id,  array|null $searchField, array|null $allowedIncludes, Model $model): void
    {
        $this->merge(['created_by' => auth()->user()->id]);
    }
}