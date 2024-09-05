<?php

namespace App\Modules\core\services\auth;

use App\Models\User;
use App\Modules\core\interfaces\auth\SignInInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInService implements SignInInterface
{
    /**
     * Summary of signIn
     * @param Request $request
     * @param bool $isRequiredVerification
     * @return array
     */
    public function signIn (Request $request, bool $isRequiredVerification) : array
    {
        try{
            if (!Auth::attempt($request->only(['email', 'password']))) authException();

            if($isRequiredVerification){
                $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
            }else{
                $user = User::where('email', $request->email)->first();
            }

            return [
                'status' => 200,
                'message' => 'User signed successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ];
        }catch (Exception $exception){
            serverException();
        }
    }
}