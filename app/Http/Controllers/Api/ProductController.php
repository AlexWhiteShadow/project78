<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll()
    {
        return $this->productService->getAll();
    }

    public function show($id)
    {
        return $this->productService->show($id);
    }

    public function create(CreateProductRequest $request)
    {
        return $this->productService->create(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('category_id'),
            $request->file('main_image')
        );
    }
//
//    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
//    {
//        return $this->productService->update(
//            $id, $updateCategoryRequest->input('name'), $updateCategoryRequest->input('description')
//        );
//    }
//
    public function delete(int $id)
    {
        return $this->productService->delete($id);
    }
}
