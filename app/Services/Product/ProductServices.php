<?php
namespace App\Services\Product;

use App\Models\Product;

class ProductServices
{

    public function index($requestUser): array
    {
        $products = Product::all();

        return [
            'success' => true,
            'message' => 'Showing all products',
            'status' => 200,
            'data' => [
                'All products' => $products
            ],
        ];

    }

    public function show($productId): array
    {
        $product = Product::where('id', $productId)->first();

        return [
            'success' => true,
            'message' => 'Showing the product',
            'status' => 200,
            'data' => [
                'Product' => $product
            ],
        ];
    }

    public function store($requestUser, $validatedData): array
    {
        $product = Product::where('producer_id', $requestUser->id)
            ->where('name', $validatedData['name'])
            ->where('price', $validatedData['price'])
            ->first();

        if ($product) {
            return [
                'success' => false,
                'message' => 'This has product already been created',
                'status' => 400
            ];
        }

        $product = $requestUser->products()->create($validatedData);

        if (!$product) {
            return [
                'success' => false,
                'message' => "Product not created",
                'status' => 400
            ];
        }

        return [
            'success' => true,
            'message' => 'Product created successfully',
            'status' => 201,
            'data' => [
                'Product' => $product
            ],
        ];

    }

    public function update($requestUser, $validatedData): array
    {
        $product = $requestUser->products()->where('id', $validatedData['id'])->first();

        $product->update($validatedData);

        $product->fresh();

        return [
            'success' => true,
            'message' => 'Product updated successfully',
            'status' => 200,
            'data' => [
                'Product' => $product,
            ],
        ];
    }
    public function affiliate()
    {

    }



    public function destroy($requestUser, $validatedData): array
    {
        $product = $requestUser->products()->where('id', $validatedData['id'])->first();

        $product->delete();

        $product = $requestUser->products()->where('id', $validatedData['id'])->first();

        if ($product) {
            return [
                'success' => false,
                'message' => 'Product not deleted',
                'satus' => 400
            ];
        }

        return [
            'success' => true,
            'message' => 'Product deleted successfully',
            'status' => 200,
        ];
    }
}
