<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Requests\AffiliateLink\AffiliateLinkDestroyRequest;
use App\Models\User;
use App\Models\AffiliateLink;
use Illuminate\Http\JsonResponse;
use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\AffiliateLink\AffiliateLinkServices;
use App\Http\Requests\AffiliateLink\AffiliateLinkStoreRequest;

class AffiliateLinkController extends Controller
{
    protected $affiliateLinkServices;

    public function __construct(AffiliateLinkServices $als)
    {
        $this->affiliateLinkServices = $als;
    }
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', User::class);

        $response = $this->affiliateLinkServices->index();

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function getMyAffiliateLinks(): JsonResponse
    {
        Gate::authorize('getMyAffiliateLinks', AffiliateLink::class);

        $response = $this->affiliateLinkServices->getMyAffiliateLinks(auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function store(AffiliateLinkStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Gate::authorize('create', User::class);

        $response = $this->affiliateLinkServices->store(auth()->user(), $validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }


    public function destroy(AffiliateLinkDestroyRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Gate::authorize('delete', AffiliateLink::class);
        dd(print (1));
        $response = $this->affiliateLinkServices->destroy($validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

}
