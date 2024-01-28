<?php

namespace App\Http\Requests;

use App\Models\Designation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DesignationStoreUpdateRequest extends FormRequest
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
        $designation_id = $this->route('designation');
        return [
            'title' => ['required', Rule::unique(Designation::class)->ignore($designation_id)],
            'description' => ['nullable']
        ];
    }
}
