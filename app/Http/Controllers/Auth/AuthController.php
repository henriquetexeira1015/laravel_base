<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\JsonResponseHelper;
use App\Services\Auth\AuthServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;

class AuthController extends Controller
{
    private $authServices;
    public function __construct(AuthServices $as)
    {
        $this->authServices = $as;
    }
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $response = $this->authServices->login($validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function logout()
    {

    }
}
