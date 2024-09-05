<?php

namespace  App\Modules\core\requests\crud;

use App\Modules\core\requests\BaseRequest;

class BaseStoreRequest extends BaseRequest
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
}
