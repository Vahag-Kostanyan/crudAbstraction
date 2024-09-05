<?php

namespace App\Modules\core\interfaces\auth;

use Illuminate\Http\Request;

interface SignInInterface
{
    /**
     * Summary of signIn
     * @param Request $request
     * @param bool $isRequiredVerification
     * @return array
     */
    public function signIn (Request $request,  bool $isRequiredVerification) : array;
}