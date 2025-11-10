<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductDestroyRequest;
use App\Http\Requests\Product\ProductShowRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\Product\ProductServices;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class productController extends Controller
{
    private $productServices;
    public function __construct(ProductServices $ps)
    {
        $this->productServices = $ps;
    }
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Product::class);

        $response = $this->productServices->index(auth()->user());

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function show(ProductShowRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Gate::authorize('viewAny', Product::class);

        $response = $this->productServices->show($validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Gate::authorize('create', Product::class);

        $response = $this->productServices->store(auth()->user(), $validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function update(ProductUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::where('id', $validatedData['id'])->first();

        Gate::authorize('update', $product);

        $response = $this->productServices->update(auth()->user(), $validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }

    public function destroy(ProductDestroyRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::where('id', $validatedData['id'])->first();

        Gate::authorize('delete', $product);

        $response = $this->productServices->destroy(auth()->user(), $validatedData);

        return JsonResponseHelper::jsonResponseFormater($response);
    }
}
