<?php

namespace App\Modules\core\services\auth;

use App\Models\User;
use App\Modules\core\interfaces\auth\SignUpInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpService implements SignUpInterface
{
    /**
     * Summary of signUp
     * @param Request $request
     * @return array
     */
    public function signUp (Request $request) : array 
    {
        try{
            User::create([
                'name' =>  $request->name,
                'email' =>   $request->email,
                'password' =>   Hash::make($request->password),
            ]);

            return [
                'status' => true,
                'message' => 'User registered successfully'
            ];
        }catch (Exception $exception){
            serverException();
        }
    }
}