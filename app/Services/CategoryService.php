<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.06.24
 * Time: 9:45
 */

namespace App\Services;


use App\Models\Category;

class CategoryService
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function createCategory(string $name, string $description, ?int $subCategoryId = null)
    {
        $insertStruct = [
            'name' => $name,
            'description' => $description
        ];

        if(!is_null($subCategoryId)){
            $insertStruct['category_id'] = $subCategoryId;
        }

        Category::create($insertStruct);

        return $this->responseService->successResponse('Category created');
    }
}