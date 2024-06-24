<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->AuthService = $authService;
    }

    public function signIn(SignInRequest $request)
    {
        return $this->AuthService->signIn($request->input('email'), $request->input('password'));
    }

    public function signUp(SignUpRequest $request)
    {
        return $this->AuthService->signUp(
            $request->input('email'), $request->input('password'), $request->input('password_confirmation')
        );
    }

    public function test()
    {
        return $this->AuthService->test();
    }
}
