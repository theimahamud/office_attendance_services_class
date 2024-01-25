<?php

namespace App\Http\Requests;

use App\Constants\BloodGroup;
use App\Constants\Gender;
use App\Constants\MaritalStatus;
use App\Constants\Role;
use App\Constants\Status;
use App\Constants\Type;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Password::defaults()],
            'birth_date' => ['required', 'date'],
            'hire_date' => ['required', 'date'],
            'role' => ['required', 'string','in:' . implode(',', Role::roles)],
            'department_id' => ['required', 'exists:departments,id'],
            'designation_id' => ['required', 'exists:designations,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:' . implode(',', Status::status)],
            'gender' => ['nullable', 'in:' . implode(',', Gender::gender)],
            'type' => ['nullable', 'in:' . implode(',', Type::types)],
            'blood_group' => ['nullable', 'in:' . implode(',', BloodGroup::blood_group)],
            'marital_status' => ['nullable', 'in:' . implode(',', MaritalStatus::marital_status)],
            'country_id' => ['nullable', 'exists:countries,id'],
        ];
    }
}
