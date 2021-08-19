<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Categories\StoreCategoryRequest;
use App\Repositories\CategoryRepository;
use Exception;

class ApiCategoryController extends Controller
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryRepository->store($request->all());
            return response()->json(['category' => $category], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
