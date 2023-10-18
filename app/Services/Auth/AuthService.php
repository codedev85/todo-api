<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function authenticate($user): array
    {

        try {

            $validateUser = Validator::make($user,
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return [
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                    'statusCode' => 401
                ];
            }

            if(!Auth::attempt(['email' => $user['email'],'password' => $user['password']])){
                return [
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                    'errors' => 'Email & Password does not match with our record.',
                    'statusCode' => 401,
                    'token' => null
                ];
            }

            $user = User::where('email', $user['email'])->first();

            $data['user'] = $user;
            $data['access_token'] = $user->createToken("API TOKEN")->plainTextToken;

            return [
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $data,
                'statusCode' => 200,
            ];

        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => 'An issue occurred',
                'errors' => $th->getMessage(),
                'statusCode' => 500,
                'token'=> null
            ];
        }
    }
}
