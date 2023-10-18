<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Auth extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService  $authService)
    {
        $this->authService = $authService;
    }

    public function authenticateUser(Request $request):JsonResponse
    {

        $auth =  $this->authService->authenticate($request->all());

        $auth['status'] ?

        $response = $this->sendResponse($auth['token'], $auth['message']):

        $response = $this->sendError($auth['message'],$auth['errors'], $auth['statusCode']);

        return $response;

    }
}
