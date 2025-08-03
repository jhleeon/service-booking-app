<?php

namespace App\Services\User;

class BookingService
{
    public function __construct()
    {
        //
    }

    /**
     * Store a booking of a user. 
     */
    public function bookingService($authUser, $bookingData)
    {
        $data = [
            'service_id' => $bookingData['service'],
            'booking_date' => $bookingData['booking_date'],
        ];

        $booking = $authUser->bookings()->create($data);

        return $booking->fresh();
    }
}
