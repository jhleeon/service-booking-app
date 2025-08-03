<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Booking\BookingCollection;
use App\Services\Admin\BookingService;
use Exception;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    /**
     * Get all user bookings.
     */
    public function index()
    {
        try {
            $bookings = $this->bookingService->bookings();

            if ($bookings) {
                return ApiResponse::success('All bookings', new BookingCollection($bookings), 200);
            }

            return ApiResponse::success('No bookings found.', [], 200);
        } catch (Exception $e) {
            Log::error("Error: {$e->getMessage()} on line {$e->getLine()} in {$e->getFile()}");
            return ApiResponse::error('Something went wrong. Please try again.', 500);
        }
    }
}
