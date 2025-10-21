<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;

class UserController extends Controller
{
    private $userServices;
    public function __construct(UserServices $us)
    {
        $this->userServices = $us;
    }
    public function index(): JsonResponse
    {
        $response = $this->userServices->index();

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $response = $this->userServices->store($validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->userServices->show($id);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $response = $this->userServices->update($validatedData, auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function destroy(): JsonResponse
    {
        $response = $this->userServices->destroy(auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

}
