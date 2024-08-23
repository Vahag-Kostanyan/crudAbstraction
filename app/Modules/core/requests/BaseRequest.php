<?php

namespace  App\Modules\core\requests;

use Illuminate\Contracts\Validation\Validator;
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
     * This function is called when validation completes
     * @return void
     */
    public function after_validation(): void {}
}
