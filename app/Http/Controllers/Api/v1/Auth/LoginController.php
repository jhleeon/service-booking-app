<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Resources\Api\v1\Auth\LoginResource;
use App\Services\Auth\LoginService;
use Throwable;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $loginService
    ) {}

    /**
     * Create token and login a user.
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        try {
            if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return ApiResponse::error('Invalid credentials', 400);
            }

            $authUser = Auth::user();

            if (!$authUser) {
                return ApiResponse::error('User not found', 404);
            }

            $token = $this->loginService->createToken($authUser);

            return ApiResponse::success('Login success', ['token' => $token, 'user' => new LoginResource($authUser)], 200);
        } catch (Throwable $e) {

            if ($e instanceof CustomException) {
                return ApiResponse::error($e->getMessage(), $e->getCode());
            }

            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Login failed', 500);
        }
    }
}
