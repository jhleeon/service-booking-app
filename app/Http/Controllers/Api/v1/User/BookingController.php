<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\Booking\CreateBookingRequest;
use App\Http\Resources\Api\v1\Booking\BookingResource;
use App\Services\User\BookingService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService,
    ) {}

    /**
     * Create a service booking.
     */
    public function store(CreateBookingRequest $request)
    {
        $bookingData = $request->validated();

        try {
            $authUser = Auth::user();

            if (!$authUser) {
                return ApiResponse::error('User not found', 404);
            }

            $booking = $this->bookingService->bookingService($authUser, $bookingData);

            return ApiResponse::success('Booking Successfull', new BookingResource($booking), 201);
        } catch (Exception $e) {
            Log::error([$e->getMessage(), $e->getLine()]);
            return ApiResponse::error('Booking failed', 500);
        }
    }
}
