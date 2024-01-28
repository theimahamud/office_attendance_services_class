<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'max:255', 'string'],
            'end_date' => ['required', 'max:255', 'string'],
            'status' => ['required', 'max:255', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}
