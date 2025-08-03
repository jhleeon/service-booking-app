<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Helper\ApiResponse;
use App\Exceptions\CustomException;
use App\Http\Requests\Api\v1\Admin\Service\CreateServiceRequest;
use App\Http\Requests\Api\v1\Admin\Service\UpdateServiceRequest;
use App\Http\Resources\Api\v1\Service\ServiceResource;
use App\Services\Admin\ServiceService;
use Exception;


class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $service
    ) {}

    /**
     * Create a service.
     */
    public function store(CreateServiceRequest $request)
    {
        $serviceData = $request->validated();

        try {

            $service = $this->service->createService($serviceData);

            return ApiResponse::success('Service create succesfull', new ServiceResource($service), 201);
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Service create failed', 500);
        }
    }

    /**
     * Update a service by ID.
     */
    public function update(UpdateServiceRequest $request, int $id)
    {
        $updateData = $request->validated();

        try {
            if (empty($id)) {
                return ApiResponse::error('service not found', 404);
            }

            $service = $this->service->updateService($id, $updateData);

            return ApiResponse::success('Service update successfull', new ServiceResource($service), 200);
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");

            if ($e instanceof CustomException) {
                return ApiResponse::error($e->getMessage(), $e->getCode());
            }

            return ApiResponse::error('Service update failed', 500);
        }
    }

    /**
     * Delete a service by ID.
     */
    public function destroy($id)
    {
        try {
            if (empty($id)) {
                return ApiResponse::error('service not found', 400);
            }

            $response = $this->service->deleteService($id);

            if ($response) {
                return ApiResponse::success('Service delete successfull', [], 200);
            }
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");

            if ($e instanceof CustomException) {
                return ApiResponse::error($e->getMessage(), $e->getCode());
            }

            return ApiResponse::error('Service delete failed', 500);
        }
    }
}
