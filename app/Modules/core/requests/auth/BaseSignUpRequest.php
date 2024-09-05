<?php

namespace  App\Modules\core\requests\auth;

use App\Modules\core\requests\BaseRequest;

class BaseSignUpRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'max:100']
        ];
    }
}