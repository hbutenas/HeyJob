<?php

namespace App\Http\Requests\Api\V1\Jobs;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
            'title' => ['required', 'string', 'regex:/^[\pL\pN\s]+$/u', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'regex:/^[\pL\pN\s\'\"]+$/u', 'min:2', 'max:1000'],
            'location' => ['required', 'string', 'regex:/^[\pL\pN\s\'\",]+$/u', 'min:2', 'max:255'],
            'application_deadline' => ['required', 'date_format:Y-m-d H:i:s', 'after:now'],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')],
        ];
    }
}
