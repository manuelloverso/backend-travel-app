<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
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
            'name' => 'required|string|min:2|max:50',
            'image' => 'nullable|image|max:5000',
            'destination' => 'required|string|max:50',
            'departure_date' => 'required|date|after_or_equal:today',
            'trip_duration' => 'nullable|integer|min:1|max:30',
            'number_of_people' => 'nullable|integer|min:1|max:50',
            'available_budget' => 'nullable|integer|max:100000',
        ];
    }
}
