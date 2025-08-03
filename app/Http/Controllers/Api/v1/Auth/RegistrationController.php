<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\RegistrationRequest;
use App\Http\Resources\Api\v1\Auth\RegistrationResource;
use App\Services\Auth\RegistrationService;
use Exception;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function __construct(
        protected RegistrationService $regService
    ) {}

    /**
     * Regster a user in system.
     */
    public function registration(RegistrationRequest $request)
    {
        $userData = $request->validated();

        try {
            $registeredUser = $this->regService->registration($userData);

            return ApiResponse::success('Registration successfully', new RegistrationResource($registeredUser), 201);
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Registration failed', 500);
        }
    }
}
