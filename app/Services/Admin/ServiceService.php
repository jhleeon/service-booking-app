<?php

namespace App\Services\Admin;

use App\Exceptions\CustomException;
use App\Models\Service;

class ServiceService
{
    /**
     * create a service.
     */
    public function createService($serviceData)
    {
        $data = [
            'name' => $serviceData['name'],
            'description' => $serviceData['description'],
            'price' => $serviceData['price'],
        ];

        if (!empty($serviceData['status'])) {
            $data['status'] = $serviceData['status'];
        }

        $service = Service::create($data)->fresh();

        return $service;
    }

    /**
     * update a service by ID.
     */
    public function updateService($id, $updateData)
    {
        $service = Service::where('id', $id)->first();

        if (!$service) {
            throw new CustomException('Service not found', 404);
        }

        $data = [
            'name' => $updateData['name'],
            'description' => $updateData['description'],
            'price' => $updateData['price'],
            'status' => $updateData['status']
        ];

        $service->update($data);

        return $service;
    }

    /**
     * Delete a service by ID.
     */
    public function deleteService($id)
    {
        $service = Service::where('id', $id)->first();

        if (!$service) {
            throw new CustomException('Service not found', 400);
        }

        $service = $service->delete();

        return $service;
    }
}
