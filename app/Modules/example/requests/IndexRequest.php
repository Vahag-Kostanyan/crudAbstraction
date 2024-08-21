<?php

namespace App\Modules\example\requests;
use App\Modules\core\requests\BaseRequest;


class IndexRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['name' => ['required']];
    }
}