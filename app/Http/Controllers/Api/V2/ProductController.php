<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(9);

        return ProductResource::collection($products);
    }
    public function show($id)
    {
        $product = Product::with('comments')->find($id);

        if (!$product) {
            return new JsonResponse(['message' => 'Object Not Found'], 404);
        }

        return new ProductResource($product);
    }

}
