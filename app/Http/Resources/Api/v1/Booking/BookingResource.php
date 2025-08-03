<?php

namespace App\Http\Resources\Api\v1\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user->name,
            'service' => $this->service->name,
            'date' => $this->booking_date,
            'status' => $this->status,
        ];
    }
}
