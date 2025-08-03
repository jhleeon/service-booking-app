<?php

namespace App\Http\Requests\Api\v1\Admin\Service;

use App\Traits\ValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:30'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'status' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name may not be greater than 30 characters.',

            'description.required' => 'Description is required.',

            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0.01.',

            'status.required' => 'Status is required.',
            'status.string' => 'Status must be a string.',
        ];
    }
}
