<?php

namespace App\Modules\example\requests;
use App\Modules\core\requests\BaseRequest;


class StoreRequest extends BaseRequest
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
    public function after_validation(): void
    {
        $this->merge(['created_by' => auth()->user()->id]);
    }


}