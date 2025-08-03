<?php

namespace App\Http\Requests\Api\v1\User\Booking;

use App\Traits\ValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    use ValidationErrorResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service' => ['required'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['sometimes', 'required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Please select a service.',
            'booking_date.required' => 'Plese select a booking date.',
            'booking_date.date' => 'Booking date format is not accepted.',
            'booking_date.after_or_equal' => 'Booking date cannot be in the past.',
            'status.required' => 'Status is required',
            'status.string' => 'Status must be a string.',
        ];

    }
}