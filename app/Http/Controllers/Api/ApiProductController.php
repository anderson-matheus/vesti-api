<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Products\StoreProductRequest;
use App\Repositories\ProductRepository;

class ApiProductController extends Controller
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->productRepository->store($request->all());
            return response()->json(['product' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
