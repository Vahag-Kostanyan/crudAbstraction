<?php

namespace App\Modules\core\interfaces\auth;

use App\Modules\core\requests\auth\BaseSignUpRequest;
use Illuminate\Http\Request;

interface SignUpInterface
{
    /**
     * Summary of signUp
     * @param Request $request
     * @return array
     */
    public function signUp (Request $request) : array;
}