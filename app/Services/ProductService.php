<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.06.24
 * Time: 16:07
 */

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function getAll()
    {
        $products = Product::all();
        return $this->responseService->successResponseWithResourceCollection(
            'All products', ProductResource::class, $products
        );
    }

    public function show(int $id)
    {
        $product = Product::where('id', $id)->get();
        return $this->responseService->successResponseWithResourceCollection(
            'Product', ProductResource::class, $product
        );
    }

    public function create(
        string $name,
        string $description,
        string $price,
        int $categoryId,
        UploadedFile $mainImage
    )
    {
        $mainImageFileName = $this->storeFileFromUploadedFileInstance($mainImage);

        $insertStruct = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'main_image' => $mainImageFileName, //asset('/storage/images/' . $mainImageFileName),
            'category_id' => $categoryId
        ];

        Product::create($insertStruct);

        return $this->responseService->successResponse('Product created');
    }

    public function update(
        int $id,
        string $name,
        string $description,
        string $price,
        int $categoryId,
        ?UploadedFile $mainImage
    )
    {
        $productModel = Product::find($id);

        if(!is_null($productModel)) {

            if (!is_null($mainImage)) {

                Storage::disk('public')->delete('images/' . $productModel->main_image);
                $mainImageFileName = $this->storeFileFromUploadedFileInstance($mainImage);
                $productModel->main_image = $mainImageFileName;

                Storage::disk('public')->path('/images/' . $mainImageFileName);

            }
            $productModel->name = $name;
            $productModel->description = $description;
            $productModel->price = $price;
            $productModel->category_id = $categoryId;
            $productModel->update();

            return $this->responseService->successResponse('Product updated');
        } else {
            return $this->responseService->errorResponse('Product not found and not updated', 404);
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if(!is_null($product)) {

            if (Storage::disk('public')->exists('images/' . $product->main_iamge)) {
                Storage::disk('public')->delete('images/' . $product->main_iamge);
            }
            $product->delete();

            return $this->responseService->successResponse('Product deleted');
        } else {
            return $this->responseService->errorResponse('Product not found and not deleted', 404);
        }
    }

    private function storeFileFromUploadedFileInstance(UploadedFile $file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('images', $fileName, 'public');

        return $fileName;
    }
}