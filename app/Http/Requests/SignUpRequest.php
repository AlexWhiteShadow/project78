<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Services\ResponseService;

class SignUpRequest extends FormRequest
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        $this->responseService->errorResponseWithException($message);

    }
}
