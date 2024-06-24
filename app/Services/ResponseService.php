<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ResponseResourceCollection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\Collection;

class ResponseService
{
    private array  $responseData;

    private function setMessageFieldIfNotNull(?string $message)
    {
        if(!is_null($message)){
            $this->responseData['message'] = $message;
        }
    }

    public function successResponse(?string $message = null)
    {
        $this->responseData['Success'] = true;
        $this->setMessageFieldIfNotNull($message);

        return response()->json($this->responseData);
    }

    public function errorResponse(?string $message = null, ?int $code = null)
    {
        $this->responseData['Success'] = false;
        $this->setMessageFieldIfNotNull($message);

        return response()->json($this->responseData, $code ?? 200);
    }

    public function successResponseWithKeyValueData(array $keyValueData, ?string $message = null)
    {
        $this->responseData['Success'] = true;
        $this->setMessageFieldIfNotNull($message);
        $result = array_merge($this->responseData, $keyValueData);

        return response()->json($result);
    }

    public function errorResponseWithKeyValueData(array $keyValueData, ?string $message = null, ?int $code = null)
    {
        $this->responseData['Success'] = false;
        $this->setMessageFieldIfNotNull($message);
        $result = array_merge($this->responseData, $keyValueData);

        return response()->json($result, $code ?? 200);
    }

    public function errorResponseWithException(string $message, int $code = 400)
    {
        throw new HttpResponseException(
            response()->json([
                'Success' => false,
                'message' => $message,
            ], $code)
        );
    }

    public function successResponseWithResourceCollection(
        string $message, string $resourceClassName, $collectionToResponse
    )
    {
        $resourceInstance = new $resourceClassName($collectionToResponse);
        $resourceCollectionClassName = $resourceClassName . 'Collection';
        return new $resourceCollectionClassName(true, $message, $resourceInstance);
    }
}