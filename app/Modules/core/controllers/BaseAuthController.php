<?php

namespace App\Modules\core\controllers;
use App\Http\Controllers\Controller;
use App\Modules\core\requests\auth\BaseSignInRequest;
use App\Modules\core\requests\auth\BaseSignUpRequest;
use App\Modules\core\services\auth\SignInService;
use App\Modules\core\services\auth\SignUpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseAuthController extends Controller {
    protected bool $isRequiredVerification = false;
    protected  string $signUpRequestClass = BaseSignUpRequest::class;
    protected  string $signInRequestClass = BaseSignInRequest::class;
    protected  string $signUpServiceClass = SignUpService::class;
    protected string $signInServiceClass = SignInService::class;

    /**
     * Summary of signUp
     * @param BaseSignUpRequest $request
     * @return JsonResponse
     */
    public function signUp (Request $request) : JsonResponse
    {
        app($this->signUpRequestClass);
        return response()->json(app($this->signUpServiceClass)->signUp($request), 201);
    }

    /**
     * Summary of signIn
     * @param BaseSignInRequest $request
     * @return JsonResponse
     */
    public function signIn (BaseSignInRequest $request) : JsonResponse
    {
        app($this->signInRequestClass);
        return response()->json(app($this->signInServiceClass)->signIn($request, $this->isRequiredVerification), 200);
    }
}