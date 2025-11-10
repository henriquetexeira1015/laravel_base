<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserDeleteOtherUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Helpers\JsonResponseHelper;
use App\Services\User\UserServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserUpdateOtherUserRequest;

class UserController extends Controller
{
    private $userServices;
    public function __construct(UserServices $us)
    {
        $this->userServices = $us;
    }
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', User::class);

        $response = $this->userServices->index();

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $response = $this->userServices->store($validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function show(UserShowRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $showingUser = User::where('id', $validatedData['id'])->first();

        Gate::authorize('view', $showingUser);

        $response = $this->userServices->show($request);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $response = $this->userServices->update($validatedData, auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function updateOtherUser(UserUpdateOtherUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $updatingUser = User::where('id', $validatedData['id'])->first();

        Gate::authorize('updateOtherUser', User::class);

        $response = $this->userServices->updateOtherUser($validatedData, $updatingUser);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function destroy(): JsonResponse
    {
        $response = $this->userServices->destroy(auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function destroyOtherUser(UserDeleteOtherUserRequest $request)
    {
        $validatedData = $request->validated();

        $deletingUser = User::where('id', $validatedData['id'])->first();

        Gate::authorize('deleteOtherUser', $deletingUser);

        $response = $this->userServices->destroyOtherUser($deletingUser);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

}