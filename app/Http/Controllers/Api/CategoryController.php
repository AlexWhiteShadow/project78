<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        return $this->categoryService->createCategory(
            $request->input('name'),
            $request->input('description'),
            $request->input('sub_category_id')
        );
    }
}
