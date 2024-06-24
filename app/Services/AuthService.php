<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\UserAuthenticatable;

class AuthService
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function signUp(string $email, string $password, string $passwordConfirmation)
    {
        UserAuthenticatable::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $this->responseService->successResponse('User has signed up');
    }

    public function signIn(string $email, string $password)
    {
        $token = auth()->attempt(['email' => $email, 'password' => $password]);

        if ($token) {
            $tokenExpiresIn = auth()->factory()->getTTL();

            return $this->responseService->successResponseWithKeyValueData([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in_minutes' => $tokenExpiresIn,
            ],
                'User has signed in'
            );
        }
        return $this->responseService->errorResponse('User has not signed in', 401);
    }

    public function test()
    {
        return $this->responseService->successResponse('ok');
    }

}