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
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('user');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($userId)],
            'password' => ['nullable', Password::defaults()],
            'birth_date' => ['required', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:'.implode(',', Status::status)],
            'gender' => ['nullable', 'in:'.implode(',', Gender::gender)],
            'type' => ['nullable', 'in:'.implode(',', Type::types)],
            'blood_group' => ['nullable', 'in:'.implode(',', BloodGroup::blood_group)],
            'marital_status' => ['nullable', 'in:'.implode(',', MaritalStatus::marital_status)],
            'country_id' => ['nullable', 'exists:countries,id'],
        ];

        if (auth()->user()->isAdmin()) {
            $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255',  Rule::unique(User::class)->ignore($userId)];
            $rules['hire_date'] = ['required', 'date'];
            $rules['role'] = ['required', 'string', 'in:'.implode(',', Role::roles)];
            $rules['department_id'] = ['required', 'exists:departments,id'];
            $rules['designation_id'] = ['required', 'exists:designations,id'];
        } else {
            $rules['email'] = ['nullable', 'string', 'lowercase', 'email', 'max:255',  Rule::unique(User::class)->ignore($userId)];
            $rules['hire_date'] = ['nullable', 'date'];
            $rules['role'] = ['nullable', 'string', 'in:'.implode(',', Role::roles)];
            $rules['department_id'] = ['nullable', 'exists:departments,id'];
            $rules['designation_id'] = ['nullable', 'exists:designations,id'];
        }

        return $rules;

    }
}
