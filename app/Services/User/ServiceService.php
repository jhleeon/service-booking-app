<?php

namespace App\Services\User;

use App\Models\Service;

class ServiceService
{
    public function __construct()
    {
        //
    }

    /**
     * Retrive all services from database.
     * */
    public function services()
    {
        $services = Service::paginate(10);

        return $services;
    }
}
