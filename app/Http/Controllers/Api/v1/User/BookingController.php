<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\Booking\CreateBookingRequest;
use App\Http\Resources\Api\v1\Booking\BookingCollection;
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
     * Get all bookings of a user.
     */
    public function index()
    {
        try {

            $authUser = Auth::user();

            if (!$authUser) {
                return ApiResponse::error('User not found.', 404);
            }

            $bookings = $this->bookingService->bookings($authUser);

            if ($bookings) {
                return ApiResponse::success('All bookings', new BookingCollection($bookings), 200);
            }

            return ApiResponse::success('No bookings found.', [], 200);
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Something went wrong. Please try again.', 500);
        }
    }

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
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Booking failed', 500);
        }
    }
}
