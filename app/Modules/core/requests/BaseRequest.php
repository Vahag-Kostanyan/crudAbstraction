<?php

namespace  App\Modules\core\requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @throws HttpResponseException
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        validationException($validator->errors() ?? []);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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
    public function after_validation(int|null $id,  array|null $searchField, array|null $allowedIncludes, Model $model): void {}
}
