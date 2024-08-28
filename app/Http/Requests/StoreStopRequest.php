<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStopRequest extends FormRequest
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
            'location' => 'required|string|max:50',
            'type' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:200',
            'visited' => 'boolean',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
