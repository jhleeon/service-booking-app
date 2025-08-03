<?php

namespace App\Services\Admin;

use App\Models\Booking;

class BookingService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function bookings()
    {
        $bookings = Booking::paginate(10);

        return $bookings;
    }
}
