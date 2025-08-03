<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Service\ServiceCollection;
use App\Services\User\ServiceService;
use Exception;
use Illuminate\Support\Facades\Log;;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $service
    ) {}

    /**
     * Get all servies.
     */
    public function index()
    {
        try {
            $services = $this->service->services();

            if ($services) {
                return ApiResponse::success('All services', new ServiceCollection($services), 200);
            }

            return ApiResponse::success('No service found', [], 200);
        } catch (Exception $e) {
            Log::error([$e->getMessage(), $e->getLine()]);
            return ApiResponse::error('Something went wrong. Please try again.', 500);
        }
    }
}