<?php

namespace App\Http\Middleware;

use App\Services\ResponseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthJwtMiddleware
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();
            $data = [
                "Received Token" => $request->bearerToken(),
                "Payload" => $payload,
            ];

            $this->auth = JWTAuth::parseToken()->authenticate();

            if (!$this->auth) {
                return $this->responseService->errorResponse('Unauthorized', 401);
            }
            return $next($request);
        } catch (JWTException $e) {

            return $this->responseService->errorResponse('Unauthorized', 401);
        }
    }
}
