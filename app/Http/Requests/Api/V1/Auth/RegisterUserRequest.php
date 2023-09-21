<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed', Rules\Password::defaults()],
            'type' => [Rule::in(['employer', 'job_seeker'])]
        ];
    }
}
