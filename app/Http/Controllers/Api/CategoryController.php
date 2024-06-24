<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAll()
    {
        return $this->categoryService->getAll();
    }

    public function show($id)
    {
        return $this->categoryService->show($id);
    }

    public function create(CreateCategoryRequest $request)
    {
        return $this->categoryService->create(
            $request->input('name'),
            $request->input('description')
        );
    }

    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
    {
        return $this->categoryService->update(
            $id, $updateCategoryRequest->input('name'), $updateCategoryRequest->input('description')
        );
    }

    public function delete(int $id)
    {
        return $this->categoryService->delete($id);
    }
}
