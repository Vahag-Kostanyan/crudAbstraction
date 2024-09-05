<?php

namespace App\Modules\core\requests\auth;

use App\Modules\core\requests\BaseRequest;

class BaseSignInRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'string', 'min:3', 'max:100']
        ];
    }
}