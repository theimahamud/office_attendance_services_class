<?php

namespace App\Http\Requests;

use App\Constants\Status;
use App\Models\Leavepolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeavepolicyRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', Rule::unique(Leavepolicy::class)],
            'start_date' => ['required', 'string', 'max:255'],
            'end_date' => ['required', 'string', 'max:255'],
            'maximum_in_year' => ['required', 'integer'],
            'status' => ['required', 'in:'.implode(',', Status::status)],
            'description' => ['nullable'],
        ];
    }
}
