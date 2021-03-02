<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function login(LoginRequest $request): Response
    {
        $credentials = $request->validated();
        $token = Auth::attempt($credentials);

        if (false === $token) {
            return $this->responseFactory->json(
                ['error' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->responseFactory->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
        ], Response::HTTP_OK);
    }
}
