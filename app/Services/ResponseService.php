<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;

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
}