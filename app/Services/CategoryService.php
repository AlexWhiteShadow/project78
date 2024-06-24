<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.06.24
 * Time: 9:45
 */

namespace App\Services;


use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryService
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function getAll()
    {
        $categories = Category::all();
        return $this->responseService->successResponseWithResourceCollection(
            'All categories', CategoryResource::class, $categories
        );
    }

    public function show(int $id)
    {
        $category = Category::where('id', $id)->get();
        return $this->responseService->successResponseWithResourceCollection(
            'Category', CategoryResource::class, $category
        );
    }

    public function create(string $name, string $description)
    {
        $insertStruct = [
            'name' => $name,
            'description' => $description
        ];

        Category::create($insertStruct);

        return $this->responseService->successResponse('Category updated');
    }

    public function update(int $id, string $name, string $description)
    {
        Category::where('id', $id)->update([
            'name' => $name,
            'description' => $description
        ]);

        return $this->responseService->successResponse('Category updated');
    }

    public function delete($id)
    {
        $result = Category::where('id', $id)->delete();
        if($result) {
            return $this->responseService->successResponse('Category deleted');
        } else {
            return $this->responseService->errorResponse('Not found category to delete', 409);
        }
    }
}